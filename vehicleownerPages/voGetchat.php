<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'mechanicnowdb');
    $mechID = $_POST['mechID'];
    $sql1="SELECT * from mechanic WHERE mechID='$mechID'";
    $query_run = mysqli_query($connection, $sql1);
    while($rows = mysqli_fetch_array($query_run)){
    
    if(isset($rows['mechID'])){
        $custID = mysqli_real_escape_string($connection, $_SESSION['custID']);
        $mechID = mysqli_real_escape_string($connection, $_POST['mechID']);
        $output = "";

        $sql3 = "SELECT * FROM chat WHERE (custID = {$custID} AND mechID = {$mechID}) OR (custID = {$mechID} AND mechID = {$custID}) ORDER BY messageID ASC";
        $query3 = mysqli_query($connection, $sql3);
        if(mysqli_num_rows($query3) > 0){
            while($row = mysqli_fetch_assoc($query3)){
                if($row['role'] === "sender"){
                    $output .= '<div class=" text-dark m-3 justify-content-end text-end">
                                <div class="d-inline-block text-wrap bg-white py-2 px-3 rounded-3 shadow text-start" style="max-width: 45em; word-wrap: break-word;">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class=" text-light m-3">
                                <img src="../uploads/<?='. $rows['profile_url'].'?>" style="height: 1.5em;width: 1.5em;  border-radius: 50%; object-fit: cover;" class="rounded-circle">
                                 <div class=" d-inline-block py-2 px-3 rounded-3 text-wrap" style="background-color: #302D32; max-width: 45em; word-wrap: break-word;">
                                    <p>'. $row['message'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text text-center align-items-center">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        echo "<script>alert('No conversation found');</script>";
    }
}
?>

               