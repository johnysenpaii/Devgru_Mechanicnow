<?php 
    session_start();
    include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
    if(isset($_SESSION['mechID'])){
        $mechID = $_SESSION['mechID'];
        $custID = $_POST['cID'];
        $message = $_POST['message'];
        $role = $_POST['role'];
        //$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        //$message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql2 = "INSERT INTO chat(custID, mechID, message, role) VALUES(:cID, :mechID, :message, :role)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':cID',$custID,PDO::PARAM_STR);
            $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
            $query2->bindParam(':message',$message,PDO::PARAM_STR);
            $query2->bindParam(':role',$role,PDO::PARAM_STR);
            $query2->execute();
            // $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            //                             VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ./mechDashboard.php");
    }
?>