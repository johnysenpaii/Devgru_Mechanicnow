<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
    if(isset($_POST['send'])){
            $custID = $_POST['custID'];
            $mechID = $_POST['mID'];
            $message = $_POST['message'];
            $role = $_POST['role'];

            $sql2 = "INSERT INTO chat(custID, mechID, message, role) VALUES(:custID, :mID, :message, :role)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
            $query2->bindParam(':mID',$mechID,PDO::PARAM_STR);
            $query2->bindParam(':message',$message,PDO::PARAM_STR);
            $query2->bindParam(':role',$role,PDO::PARAM_STR);
            $query2->execute();
        // if(isset($_POST['custID']) && isset($_POST['mechID']) && isset($_POST['message'])){
            
            
        // }else{
        //     echo "<script>alert('sending failed')</script>";
        // }
        
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body style="background: #f8f8f8">
    <?php include('voHeader.php');?>
    <section class="chatsection mt-3">
        <div class="container">
            <div class="row no-glutters">

                <!-- chat list column -->
                <div class="col-md-4 text-light" style="background: #302D32">
                    <div class="name py-3 text-center">
                        <h5>Chats</h5>
                    </div>
                    <div class="row justify-content-center align-items-center pb-4 d-flex">
                        <div class="col-12 input-group-sm ">
                            <input class="form-control rounded-pill" type="text" placeholder="Filter Search" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>  
                        <?php
                            $sql="SELECT * from mechanic WHERE status='approve'";//vehicleType like '%Car%' and status='approve'"
                            $query=$dbh->prepare($sql);
                            $query->execute();
                            $results=$query->fetchALL(PDO::FETCH_OBJ);
                            $cnt=1;
                            if( $query->rowCount()>0){
                                foreach($results as $result){
                                    if($result->distanceKM <= 3.0){
                        ?>
                        <form method="POST">
                        <div class="row py-2">
                            <div class="col-md-2">
                                <img src="../img/avatar.jpg" alt="" style="height: 3em;width: 3em;" class="rounded-circle">
                            </div>
                            <input type="hidden" name="mechID" value="<?php echo htmlentities($result->mechID)?>">
                            <!-- <a class="text-light col-md-10" style="text-decoration: none;" href="" > -->
                                <div class="col-md-10">
                                    <h6><?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?></h6>
                                    <p class="fs-6"><small>This is test message</small></p>
                                    <input type="submit" name="submit" value="submit">
                                </div>
                            <!-- </a> -->
                        </div>
                        </form>
                        <?php }}}?>
                </div>

                <!-- chat column -->
                <div class="col-md-8" style="background: #f8f8f8">
                    <div class="col">
                        <div class="row bg-white py-1 text-dark align-items-center">
                            <div class="col-md-2">
                                <i class="fa-solid fa-arrow-left px-3"></i>
                                <img src="../img/avatar.jpg" alt="" style="height: 3em;width: 3em;" class="rounded-circle">
                            </div>
                            <div class="col-md-9">
                                <?php
                                    if(isset($_POST['submit'])){
                         
                                        $connection = mysqli_connect("localhost", "root", "");
                                        $db = mysqli_select_db($connection, 'mechanicnowdb');
                                        $mechID = $_POST['mechID'];
                                        //echo $mechID;
                                    $sql1="SELECT * from mechanic WHERE mechID='$mechID'";
                                    $query_run = mysqli_query($connection, $sql1);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <h5><?php echo $row['mechFirstname']?></h5>
                                <?php 
                                    $id = $row['mechID'];
                                }}?>
                                
                            </div>
                        </div>
                        <div class="row text-dark">
                            <div class="col-sm-12">
                                <?php
                                 if(isset($_POST['submit'])){
                         
                                        $connection = mysqli_connect("localhost", "root", "");
                                        $db = mysqli_select_db($connection, 'mechanicnowdb');
                                        $mechID = $_POST['mechID'];
                                        //echo $mechID;
                                        $sql1="SELECT * from mechanic WHERE mechID='$mechID'";
                                        $query_run = mysqli_query($connection, $sql1);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                    
                                    <input type="hidden" required name="mID" value="<?php echo $row['mechID']?>">
                                    
                                    <?php
                                    if(isset($row['mechID'])){
                                        $custID = mysqli_real_escape_string($connection, $_SESSION['custID']);
                                        $mechID = mysqli_real_escape_string($connection, $_POST['mechID']);
                                        // $role = mysqli_real_escape_string($connection, $_POST['role']);

                                        $sql3 = "SELECT * FROM chat WHERE (custID = {$custID} AND mechID = {$mechID}) OR (custID = {$mechID} AND mechID = {$custID}) ORDER BY messageID ASC";
                                        $query3 = mysqli_query($connection, $sql3);
                                        if(mysqli_num_rows($query3) > 0){
                                            while($row = mysqli_fetch_assoc($query3)){
                                                if($row['role'] === "sender"){ //if match then hes the sender
                                                ?>
                                                    <div class=" text-dark m-3 justify-content-end text-end">
                                                        <p  class=" d-inline-block bg-white py-2 px-4 rounded-pill"><?php echo $row['message'];?></p>
                                                        <img src="../img/avatar.jpg" alt="" style="height: 1.5em;width: 1.5em;" class="rounded-circle">
                                                    </div>
                                                <?php
                                                }else{ //hes the receiver 
                                                ?>
                                                    <div class=" text-light m-3">
                                                        <img src="../img/avatar.jpg" alt="" style="height: 1.5em;width: 1.5em;" class="rounded-circle">
                                                        <p  class=" d-inline-block py-2 px-4 rounded-pill" style="background-color: #302D32;"><?php echo $row['message'];?></p>
                                                    </div>
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row px-2 py-2" style="background: #302D32">
                            <div class="col-md-12 d-flex align-items-center justify-content-end text-end">
                                <form method="POST">
                                    <div class="px-2 d-flex">
                                        <input type="hidden" name="custID" value="<?php echo $_SESSION['custID']?>" required>
                                        <!-- <?php
                                            if(isset($_POST['submit'])){
                                
                                                $connection = mysqli_connect("localhost", "root", "");
                                                $db = mysqli_select_db($connection, 'mechanicnowdb');
                                                $mechID = $_POST['mechID'];
                                            $sql1="SELECT * from mechanic WHERE mechID='$mechID'";
                                            $query_run = mysqli_query($connection, $sql1);
                                            while($row = mysqli_fetch_array($query_run)){
                                        ?> -->
                                        <input type="hidden" required name="mID" value="<?php echo $id ?>">
                                        <!-- <?php }}?> -->
                                        <textarea name="message" id="" rows="1" class="px-2" required></textarea>
                                        <input type="hidden" name="role" value="sender">
                                    </div>
                                    <button class="btn1 fa-solid fa-paper-plane" type="submit" name="send" style="color: #F8F8F8; border: none; background-color: #302D32"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>