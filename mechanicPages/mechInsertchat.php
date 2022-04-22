<?php 
    session_start();
    include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
    if(isset($_SESSION['mechID'])){
        $mechID = $_SESSION['mechID'];
        $custID = $_POST['cID'];
        $custName = $_POST['custName'];
        $mechName = $_SESSION['mechFirstname'].' '.$_SESSION['mechLastname'];
        $message = $_POST['message'];
        $role = $_POST['role'];
        if(!empty($message)){
            $sql2 = "INSERT INTO chat(custID, mechID, custName, mechName, message, role) VALUES(:cID, :mechID, :custName, :mechName, :message, :role)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':cID',$custID,PDO::PARAM_STR);
            $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
            $query2->bindParam(':custName',$custName,PDO::PARAM_STR);
            $query2->bindParam(':mechName',$mechName,PDO::PARAM_STR);
            $query2->bindParam(':message',$message,PDO::PARAM_STR);
            $query2->bindParam(':role',$role,PDO::PARAM_STR);
            $query2->execute();
        }
    }else{
        header("location: ./mechDashboard.php");
    }
?>