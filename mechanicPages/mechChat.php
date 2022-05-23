<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$mID = $_SESSION['mechID'];

if(empty($_SESSION['mechID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['mechID']);
      }
      if(isset($_POST["logout"])) {
        $mechID=$_SESSION['mechID'];
        $sql12344="UPDATE mechanic set stats='Not active' WHERE mechID=:mechID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
        $query12344=$dbh->prepare($sql12344);
        $query12344->bindParam(':mechID', $mechID, PDO::PARAM_STR);
        $query12344->execute();
        session_destroy(); 
        unset($_SESSION['mechID']);
        header("Location:http://localhost/Devgru_Mechanicnow/login.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
    <style>
        .chatBox::-webkit-scrollbar{
            width: 0px;
        }
    </style>
</head>
<body style="background: #f8f8f8">
    <?php include('mechHeader.php');?>
    <section class="chatsection">
        <div class="container-fluid">
            <div class="row no-glutters">
                <!-- chat list column -->
                <div class="col-md-4 text-light p-0" style="background: #302D32;">
                    <div class="name py-3 text-center">
                        <h5>Chats</h5>
                    </div>
                    
                        <div class="scroll-users" style="height: 81vh ;overflow-y: auto;">
                            <?php
                                $mechID = $_SESSION['mechID'];
                                $sql="SELECT * FROM `chat` where mechID = $mechID GROUP BY `custID`";
                                $query=$dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchALL(PDO::FETCH_OBJ);
                                $cnt=1;
                                if( $query->rowCount()>0){
                                    foreach($results as $result){
                            ?>
                                <form method="POST" class="">
                                    <div class="row px-2 m-0">
                                        <button type="submit" name="submit" value="submit" class="btn btn-warning text-white shadow-none">
                                            <div class="row py-2 px-2 align-items-center">
                                                <div class="col-2 col-md-2">
                                                    <?php
                                                        $cID = $result->custID;
                                                        $sql= "SELECT * FROM customer where custID = $cID";
                                                        $query=$dbh->prepare($sql);
                                                        $query->execute();
                                                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                                                        if($query->rowCount()>0){
                                                            foreach ($results as $result3){
                                                    ?>
                                                        <img src="../uploads/<?=$result3->profile_url ?>" onerror="this.src='../img/vo.jpg';" alt="" style="height: 3em;width: 3em;  border-radius: 50%; object-fit: cover;" class="rounded-circle">
                                                    <?php }}?>
                                                </div>
                                                <input type="hidden" name="custID" value="<?php echo htmlentities($result->custID)?>">
                                                <div class="col-9 col-lg-10 text-start">
                                                    <h6><?php echo htmlentities($result->custName);?></h6>
                                                    <p class="fs-6"><small style="font-size: 12px; color: rgb(236, 236, 236);">Active Now</small></p>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </form>
                            <?php }}?>
                        </div>
                </div>
                <!-- chat column -->
                <div class="col-md-8" style="background: #f8f8f8">
                    <div class="col">
                        <div class="row bg-white py-1 text-dark align-items-center">
                            <?php
                                    if(isset($_POST['submit'])){
                         
                                        $connection = mysqli_connect("localhost", "root", "");
                                        $db = mysqli_select_db($connection, 'mechanicnowdb');
                                        $custID = $_POST['custID'];
                                        //echo $mechID;
                                        $sql1="SELECT * from customer WHERE custID='$custID'";
                                        $query_run = mysqli_query($connection, $sql1);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                            <div class="col-md-2 col-2 text-end">
                                <i class="fa-solid fa-arrow-left px-3" style="display: none"></i>
                                <img src="../uploads/<?=$row['profile_url']?>" onerror="this.src='../img/mech.jpg';" alt="" style="height: 3em;width: 3em; border-radius: 50%; object-fit: cover;" >
                            </div>
                            <div class="col-9 col-md-8">
                                <h5><?php echo $row['custFirstname']?> <?php echo $row['custLastname']?></h5>
                                <?php 
                                    $id = $row['custID'];
                                    $custName = $row['custFirstname'].' '.$row["custLastname"];
                                }}?>
                                
                            </div>
                        </div>
                        <div class="row text-dark">
                            <div class="col-sm-12 chatBox" style="height: 73.7vh ;overflow-y: auto;">
                                
                            </div>
                        </div>
                        <div class="row pt-2" style="background: #302D32">
                            <form class="typing-area">
                                <div class="input-group pb-2 g-1">
                                    <div class="col-10 col-sm-11">
                                    <input type="hidden" required class="custID" name="cID" value="<?php echo $id ?>">
                                    <input type="hidden" required name="custName" value="<?php echo $custName ?>">
                                    <input type="text" name="message" placeholder="Type message here..." class="form-control rounded-pill shadow-none border-0 input-field1" required autocomplete="off">
                                    <input type="hidden" name="role" value="receiver">
                                    </div>
                                    <button class="btn1 fa-solid fa-paper-plane col-sm-1 col-2 pt-0" type="submit" name="send" style="color: #F8F8F8; border: none; background-color: #302D32"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- <script type="text/javascript">

        var mobile = (/iphone|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));  
        if (mobile) {
            $('.chatSec').css('display', 'none'); // OR you can use $('.navWrap').hide();
            $('#idChat').click(function () {
                if (this.id == 'idChat') {
                    $('.chatSec').css('display', 'block');
                    $('.chatLists').css('display', 'none');
                }
                });
        } 
        else{

        }
    </script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/chat.js"></script>      
    <script src="../js/mechChatList.js"></script>                           
</body>
</html>