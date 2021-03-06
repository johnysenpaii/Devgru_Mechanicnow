<?php
session_start();
include('../config.php');
if(isset($_POST['logout'])) {
    $regeditid = $_SESSION['mechID'];
    $sql="UPDATE mechanic set stats='Not active' WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql);
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
    $query->execute(); 
    session_destroy();
    unset($_SESSION['mechID']);
    header('location:http://localhost/Devgru_Mechanicnow/login.php');
} 
$mechID1=$_SESSION['mechID']; 

// if(isset($_POST["verify"])){
//  $resID=intval($_POST['resID']);
//   $sql1="UPDATE request set status='verify' WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
//   $query=$dbh->prepare($sql1);
//   $query->bindParam(':resID',$resID,PDO::PARAM_STR);
//   $query->execute(); 
//   echo '<script>alert("please wait vehicle onwer to approve")</script>';


// }
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

<body id="contbody" style="background-color: #f8f8f8" onload="verify()">
    <?php include('mechHeader.php');?>
    <?php include('./mechTopnav.php');?>

    <section id="activityLog" class="container">
        <form action="" method="POST">
            <div class="row py-3 px-sm-0 px-md-3 justify-content-center pb-5">
                <div class="col-lg-8  py-4">
                    <?php
                    $mechID1=$_SESSION['mechID']; 
                        $sql="SELECT * from request WHERE mechID = $mechID1 and status='Accepted' || status='verify' order by resID DESC";
                        $query=$dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchALL(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount()>0){
                            foreach ($results as $result){                           
                                if( $result->status == 'Accepted'){
                    ?>
                    <div class="card text-dark mb-2">
                        <div class="card-body">
                            <input type="text" hidden name="resID" value="<?php echo htmlentities($result->resID);?>">
                            <small class="card-text float-end pt-0" style="color: green;"><?php echo htmlentities($result->status);?></small>
                            <h6 class="card-title"><?php echo htmlentities($result->mechName);?></h6>
                            <small class="card-text t-6"><?php echo htmlentities($result->mechRepair);?></small>
                            <div class='alert alert-primary text-start py-0 pb-1 mb-0 fw-bold'>
                                <h6 class="pt-2"><small>Note:</small></h6>
                                <small class="card-text"><?php echo htmlentities($result->specMessage);?></small>
                            </div>
                            <a class="btn btn-primary rounded-pill py-0 mt-2 shadow border-0" href="manageRequest.php?regeditid=<?php echo htmlentities($result->resID)?>"><small>Monitor Service</small></a>
                        </div>
                    </div>
                    <?php } else if($result-> status =="verify"){?>
                        <div class="card text-dark mb-2">
                        <div class="card-body">
                            <input type="text" hidden name="resID" value="<?php echo htmlentities($result->resID);?>">
                            <small class="card-text float-end pt-0" style="color: green;"><?php echo htmlentities($result->status);?></small>
                            <h6 class="card-title"><?php echo htmlentities($result->vOwnerName);?></h6>
                            <small class="card-text t-6"><?php echo htmlentities($result->mechRepair);?></small>
                            <div class='alert alert-primary text-start py-0 pb-1 mb-0 fw-bold'>
                                <h6 class="pt-2"><small>Note:</small></h6>
                                <small class="card-text"><?php echo htmlentities($result->specMessage);?></small>
                            </div>
                            <a href="manageRequest.php?regeditid=<?php echo htmlentities($result->resID)?>" id="btnn" class="btn btn-primary rounded-pill py-0 mt-2 shadow border-0"><small>Pending</small></a>
                        </div>
                    </div>
                    
                   <?php }}} else { ?>
                   
                    <div class="emptyrequest mt-5 pt-5">
                        <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                        <h6>No available activities. . .</h6>
                    </div>
                    <?php
                        }$cnt=$cnt+1;
                    ?>
                </div>
            </div>
        </form>
    </section>
    
    <script>
        function verify(){
            t = document.getElementById("status").value;
            if(t == "verify"){
                document.getElementById("btnn").innerHTML="Pending";
            }
        }
    </script>
    <script src="js/main.js"></script>
</body>

</html>