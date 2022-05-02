<?php
session_start();
include('../config.php');
$mechID1=$_SESSION['mechID']; 


if(isset($_POST['UpdateMe']))
{
    $tb = $_POST['output'];  
    $mechID=$_SESSION['mechID']; 
    $custID=$_POST['custID'];

    $sql414 = "INSERT INTO vonotification(custID, mechID, Status, progressbarStatus) VALUES(:custID, :mechID, 'verify', :tb)";
    $query414= $dbh->prepare($sql414);
    $query414->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query414->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query414->bindParam(':tb',$tb,PDO::PARAM_STR);
    $query414->execute();

    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set progressBar=:tb where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':tb',$tb,PDO::PARAM_STR);
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();

    echo "<script type='text/javascript'>confirm('Are you sure you want to update progress bar ?');</script>";
  
}

if(isset($_POST["verify"])){
  $regeditid=intval($_GET['regeditid']);
  $sql1="UPDATE request set status='verify' WHERE resID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
  $query=$dbh->prepare($sql1);
  $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
  $query->execute(); 
  echo '<script>alert("please wait vehicle onwer to approve")</script>';
  echo "<script type='text/javascript'>document.location='mechActivityLog.php';</script>";
  
  $mechID=$_SESSION['mechID']; 
  $custID=$_POST['custID'];
  $sql41 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID, :mechID, 'verify')";
  $query41= $dbh->prepare($sql41);
  $query41->bindParam(':custID',$custID,PDO::PARAM_STR);
  $query41->bindParam(':mechID',$mechID,PDO::PARAM_STR);
  $query41->execute();



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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/810a80b0a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>

<body id="contbody" style="background-color: #f8f8f8" onload="loadss()">
    <?php include('mechHeader.php');?>
    <!-- <?php include('mechTopnav.php');?> -->
    <!-- <section id="manageRequest"> -->
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
            
                <div class="row m-0 text-dark">
                    <div class="container text-dark col-12 col-md-6">
                        <div class="col-12 col-md-10 bg-white shadow p-3 mt-5 voinfo-div">
                            <h5 class="text-start title-request">Vehicle Owner Information</h6>
                            <p class="pt-2"><?php echo htmlentities($result->vOwnerName);?><p>
                        </div>
                        <div class="col-12 col-md-10 bg-white shadow p-3 mt-3 voinfo-div">
                            <h5 class="text-start mt-2 title-request">Request Information</h5>
                                    <!-- <label for="need">Service Needed: </label> -->
                            <input  name='custID' type="hidden" value="<?php echo htmlentities($result->custID);?>">
                            <input disabled class="border-0 bg-title py-2" type="text" id="need" value="<?php echo htmlentities($result->serviceNeeded);?>">
                            <div id="needs" style="display: none;">
                                <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                                <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?>
                                <?php echo htmlentities($result->time);?></p>
                            </div>
                            <div class="col-10">
                                <div class="alert alert-primary text-start py-0 pb-1 mb-0 note-alert note-vehicle shadow-sm">
                                    <div class="row noted-vehicle">
                                                    <!-- <i class="fa-solid fa-circle-exclamation col-1"></i> -->
                                        <p class="pt-1">Vehicle  Problem:</p>
                                        <p class="col-10 col-sm-11 py-1">
                                            <?php echo htmlentities($result->mechRepair);?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                                <!-- <p class="pb-1 ">Vehicle Problem: <?php echo htmlentities($result->mechRepair);?></p> -->
                                <!-- <h5>Noted Message</h5>-->
                                <!-- <p class="line-segment"><?php echo htmlentities($result->specMessage);?></p>  -->
                        </div>
                                <!-- <p class="py-2"><em>Click the progress bar and update to let your client know the status of his/her
                                        request.</em></p> -->
                                <!-- <progress id="file" style="height:50px; width: 620px;" value="<?php echo htmlentities($result->progressBar);?>" max="100" onclick="prog();"></progress> -->
                                <!-- <button type="button" class="my-2 btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">Update me <i class="bi bi-arrow-counterclockwise"></i></button> -->
                                <!-- <input  type="text" name="output" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output"> -->
                    </div>
                    <div class="visualProgress col-12 col-md-6">
                        <div class="circular-progress" id="circular-progress">
                            <div class="value-container">
                                0%
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary rounded-pill button-progress" data-bs-toggle="modal" data-bs-target="#exampleModal">Update Progress</button>
                        <input  type="hidden" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output">
                    </div>

                    <h5 class="text-center pt-2">Remarks</h5>
                        <div class="row pt-5 d-flex align-self-end justify-content-end">
                            <button type="submit" name="verify" style="display: none;" id="hide" class="btn btn-primary col-md-4 rounded-pill">Request Complete</button>
                        </div>
                </div>
                
            
            <!-- <div class="row container-fluid py-3 text-dark">
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
                        <p><?php echo htmlentities($result->vOwnerName);?><p>
                        <h5 class="text-start mt-2">Request Information</h5>
                        <label for="need">Service Needed: </label>
                        <input  name='custID' type="hidden" value="<?php echo htmlentities($result->custID);?>">
                        <input disabled class="border-0 bg-white py-2" type="text" id="need" value="<?php echo htmlentities($result->serviceNeeded);?>">
                        <div id="needs" style="display: none;">
                        <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                        <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?> 
                            <?php echo htmlentities($result->time);?></p>
                        </div>
                        <p class="pb-1 "><i>Vehicle Problem:</i> <?php echo htmlentities($result->mechRepair);?></p>
                        <h5>Noted Message</h5>
                        <p class="line-segment"><?php echo htmlentities($result->specMessage);?></p>

                        <p class="py-2"><em>Click the progress bar and update to let your client know the status of his/her
                                request.</em></p>
                        <progress id="file" style="height:50px; width: 620px;" value="<?php echo htmlentities($result->progressBar);?>" max="100" onclick="prog();"></progress>
                        <button type="button" class="my-2 btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">Update me <i class="bi bi-arrow-counterclockwise"></i></button>
                        <input  type="text" name="output" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output">
                        <h5 class="text-center">Remarks</h5>
                        <div class="row pt-5 d-flex align-self-end justify-content-end">
                            <button type="submit" name="verify" style="display: none;" id="hide" class="btn btn-primary col-md-4 rounded-pill">Request Complete</button>
                        </div>
                </div>
            </div> -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <!-- for retreival -->
                                <div class="col-12">
                                    <p><?php echo htmlentities($result->mechRepair);?></p>
                                    <label for="">Please input progress by percentage</label>
                                    <input class="form-control" type="text" id="percent" name="output" value="<?php echo htmlentities($result->progressBar);?>" placeholder="Please input Progress by percentage">
                                </div>
                                <hr class="divider">
                                <!-- for the inputs -->
                                <div class="col-12">
                                    <textarea class="form-control shadow-none" id="exampleFormControlTextarea1" placeholder="Enter Remarks..." rows="3" name="specMessage" value="specMessage"></textarea>
                                    <button type="sumbit" class="my-2 btn btn-primary rounded-pill" value="UpdateMe" name="UpdateMe" id="UpdateMe">Update me <i class="bi bi-arrow-counterclockwise"></i></button>
                                    <!-- <button>Confirm Progress</button> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <?php $cnt=$cnt+1;}}?>
        </form>
    <!-- </section> -->
    <script language=JavaScript>
    function prog() {
        var outs = document.getElementById("output");
        var ins = document.getElementById("file").value;
        document.getElementById("file").value = ins + 20;
        outs.value = document.getElementById("file").value;
    }
    function loadss(){
        var t = document.getElementById("output").value;
        if( t == 100 ){
            document.getElementById("hide").style.display = "block";
            reload();
        }
    }

    var t = document.getElementById("need").value;
        if(t == "Home Service"){
            document.getElementById("needs").style.display = "block";
        }
    //for circular progress bar
    let progressBar = document.getElementById("circular-progress");
    let valueContainer = document.querySelector(".value-container");
    let dynamicValue = document.getElementById("output").value;

    let progressValue = 0;
    let progressEndValue = 100;
    let speed = 20;

    let progress = setInterval(() => {
        progressValue++;
        valueContainer.textContent = `${progressValue}%`;
        progressBar.style.background = `conic-gradient(
            #9132da ${progressValue * 3.6}deg, 
            #b68bd6 ${progressValue * 3.6}deg
        )`;
        if (progressValue == dynamicValue) {
            clearInterval(progress);
        }
    }, speed);
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
    <script src="../js/main.js"></script>

</body>

</html>