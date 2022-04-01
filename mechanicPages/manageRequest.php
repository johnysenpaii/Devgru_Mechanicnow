<?php
session_start();
include('../config.php');
$mechID1=$_SESSION['mechID']; 

// if(isset($_POST["verify"])){
//  $resID=intval($_POST['resID']);
//   $sql1="UPDATE request set status='verify' WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
//   $query=$dbh->prepare($sql1);
//   $query->bindParam(':resID',$resID,PDO::PARAM_STR);
//   $query->execute(); 
//   echo '<script>alert("please wait vehicle onwer to approve")</script>';


// }



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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

<body id="contbody" style="background-color: #f8f8f8">
    <?php include('mechHeader.php');?>
    <!-- <?php include('mechTopnav.php');?> -->
    <section id="manageRequest">
        <form action="" method="POST">
            <?php
                        $regeditid=intval($_GET['regeditid']);
						$sql="SELECT * from request where resID=:regeditid";
						$query = $dbh->prepare($sql);
						$query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount()>0){
    						foreach($results as $result){
						?>

            <div class="row container-fluid py-3 text-dark">
                <div class="col-sm-12 col-md-6">
                    <div id="google-maps">
                        <iframe
                            src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed"
                            frameborder="0" width="100%" height="540">
                        </iframe>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 bg-white p-3 rounded-3 shadow">
                    <h5 class="text-start pt-2">Vehicle Owner Information</h6>
                        <p><?php echo htmlentities($result->vOwnerName);?></p>
                        <h5 class="text-start mt-2">Request Information</h5>
                        <p><i>Service Needed:</i> <?php echo htmlentities($result->serviceNeeded);?></p>
                        <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                        <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?>
                            <?php echo htmlentities($result->time);?></p>
                        <p class="pb-1 "><i>Vehicle Problem:</i> <?php echo htmlentities($result->mechRepair);?></p>
                        <h5>Noted Message</h5>
                        <p class="line-segment"><?php echo htmlentities($result->specMessage);?></p>

                        <p class="py-3"><em>Update the progress bar to let your client know the status of his/her
                            request.</em></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress" role="progressbar"></div>
                        </div> 
                         <button type="button" class="my-3 btn btn-primary rounded-pill" onclick="increase()">Update me <i class="bi bi-arrow-counterclockwise"></i></button>
                         <input hidden type="text" id="tb"> 
                        <div class="row pt-5 d-flex align-self-end justify-content-end">
                            <button type="button" class="btn btn-primary col-md-4 rounded-pill">Request Complete</button>
                        </div>
                </div>
            </div>
            <?php $cnt=$cnt+1;}}?>
        </form>
    </section>
    <script>
        var value = 0, 
        tb = document.getElementById("tb"),
        progress = document.getElementById("progress"); 
        function increase(){ 
            value = value + 22;
            if(value>=100) value = 100;
            tb.value = value; 
            progress.style.width = value + "%";
            progress.innerHTML = value  + "%";
            } 
    </script>

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
    <script src="js/main.js"></script>
</body>

</html>