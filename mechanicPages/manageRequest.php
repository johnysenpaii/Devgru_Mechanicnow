<?php
session_start();
include('../config.php');
$mechID1=$_SESSION['mechID']; 
$error=' ';
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

if(isset($_POST['UpdateMe']))
{
    $tb = $_POST['output'];  
    $mechID=$_SESSION['mechID']; 
    $custID=$_POST['custID'];
    $remarkID = $_POST["remarkID"];
    $remarks = $_POST["remarks"];
    $progressBar = $_POST["output"];

    $sql414 = "INSERT INTO vonotification(custID, mechID, progressbarStatus) VALUES(:custID, :mechID, :tb)";
    $query414= $dbh->prepare($sql414);
    $query414->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query414->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query414->bindParam(':tb',$tb,PDO::PARAM_STR);
    $query414->execute();

    if(isset($_POST["mechRepair"])){
        $mechRepair=implode(",",$_POST["mechRepair"]);
    }
    if(isset($_POST["remarks"])){
        $remarks=implode(",",$_POST["remarks"]);
    }
    $sql6="UPDATE progressremarks set mechRepair = :mechRepair, remarks=:remarks, progressPercentage=:progressBar WHERE remarkID=:remarkID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query12=$dbh->prepare($sql6);
    $query12->bindParam(':remarkID',$remarkID,PDO::PARAM_STR); 
    $query12->bindParam(':mechRepair',$mechRepair,PDO::PARAM_STR); 
    $query12->bindParam(':progressBar',$progressBar,PDO::PARAM_STR); 
    $query12->bindParam(':remarks',$remarks,PDO::PARAM_STR); 
    $query12->execute(); 

    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set progressBar=:tb where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':tb',$tb,PDO::PARAM_STR);
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();

    $error='<div class="col-12 col-md-10 bg-primary bg-shadowmd p-3 my-2 voinfo-div">
    <h5 class="text-start text-light title-request">Successfully updated.</h6>
</div>';
}

if(isset($_POST["verify"])){
  $regeditid=intval($_GET['regeditid']);
  $sql1="UPDATE request set status='verify' WHERE resID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
  $query=$dbh->prepare($sql1);
  $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
  $query->execute(); 


  $mechID=$_SESSION['mechID']; 
  $custID=$_POST['custID'];
  $tb = $_POST['output']; 
  $sql41 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID, :mechID, 'verify')";
  $query41= $dbh->prepare($sql41);
  $query41->bindParam(':custID',$custID,PDO::PARAM_STR);
  $query41->bindParam(':mechID',$mechID,PDO::PARAM_STR);
  $query41->execute();

    $sql="UPDATE mechanic set status='approve' where mechID=:mechID";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':mechID',$mechID,PDO::PARAM_STR); 
    $query->execute();

    $error='<div class="col-12 col-md-10 bg-info bg-shadowmd p-3 my-2 voinfo-div">
    <h5 class="text-start text-light title-request">Wait for the vehicle to confirm your complete request.</h6>
</div>';
    header("refresh:2;url=http://localhost/Devgru_Mechanicnow/mechanicPages/mechActivityLog.php");

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
        <form action="" method="POST" name="myForm" onsubmit="totalIt()">
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
                                date_default_timezone_set('Asia/Singapore');
                                $date1 = date('Y-m-d');
                                $time1 = date('H:i');
                                 if($result->date == $date1 && $result->timess == $time1){
                                                 
                                     $sql0 = "INSERT INTO vonotification(custID, mechID, status) VALUES($result->custID, $result->mechID, 'Home service')";
                                     $query0 = $dbh->prepare($sql0);
                                     $query0->execute();
     
                                     $sql10 = "INSERT INTO notification(custID, mechID, status) VALUES($result->custID, $result->mechID, 'Home service')";
                                     $query10 = $dbh->prepare($sql10);
                                     $query10->execute();
                                     
                                     $mechid1 = $_SESSION['mechID'];
                                     $sql09="UPDATE mechanic set status='busy' where mechID=:mechid1";
                                     $query09=$dbh->prepare($sql09); 
                                     $query09->bindParam(':mechid1',$mechid1,PDO::PARAM_STR); 
                                     $query09->execute();
     
                                 }
						?>
            
                <div class="row m-0 text-dark">
                    <div class="container text-dark col-12 col-md-6">
                  <?php echo $error;
                  
                   ?>
                        <div class="col-12 col-md-10 bg-white bg-shadowmd p-3 mt-3 voinfo-div">
                            <h5 class="text-start title-request">Vehicle Owner Information</h6>
                            <p class="pt-2"><?php echo htmlentities($result->vOwnerName);?><p>
                        </div>
                        <div class="col-12 col-md-10 bg-white bg-shadowmd p-3 mt-3 voinfo-div">
                            <h5 class="text-start mt-2 title-request">Request Information</h5>
                            <input  name='custID' type="hidden" value="<?php echo htmlentities($result->custID);?>">
                            <?php $cuID = $result->custID; ?>
                            <input disabled class="border-0 bg-title py-2" type="text" id="need" value="<?php echo htmlentities($result->serviceNeeded);?>">
                            <div id="needss">
                                <p>Date: <?php echo htmlentities($result->date);?></p>
                                <p>Time: <?php echo htmlentities($result->timess);?> <?php echo htmlentities($result->timess) < 12 ? 'AM' : 'PM';?></p>
                            </div>
                            <div class="col-10">
                                <div class="alert alert-primary text-start py-0 pb-1 mb-0 note-alert note-vehicle shadow-sm">
                                    <div class="row noted-vehicle">
                                        <p class="pt-1">Vehicle  Problem:</p>
                                       
                                        <?php $divProgress = explode(",", $result->mechRepair);
                                            foreach($divProgress as $t){?>
                                        <p class="col-10 col-sm-11 py-1"><?php echo $t;?></p>
                                        <?php  }?>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 rm">
                            <?php
                            // echo $mechID;
                            // echo $cuID;
                            $sql4="SELECT * from progressremarks where mechID=:mechID AND custID=:cuID  order by remarkID DESC limit 1";
                            $query5 = $dbh->prepare($sql4);
                            $query5->bindParam(':mechID',$mechID,PDO::PARAM_STR);
                            $query5->bindParam(':cuID',$cuID,PDO::PARAM_STR);
                            $query5->execute();
                            $results=$query5->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                                if($query5->rowCount()>0){
                                    foreach($results as $res){
                                        ?>
                                        <div class="rmScroll col-12 col-md-10 bg-white bg-shadowmd p-3 mt-3 voinfo-div">
                                            <h5 class="text-start title-request">Remarks</h6>
                                            <div class="remarksScroll bg-white">
                                                <?php
                                                $Rid = $res->remarkID;
                                                $currentProg = $res->remarks; //will retrieve the remarks
                                                $latestProgress = $_POST["latestProg"] ?? null;
                                                $divProgress = explode("@", $res->remarks);
                                                $divProgLength = count($divProgress);
                                                $separator = ",";//the separator
                                                ?>
                                                <input type="hidden" id="currentProg" value="<?php echo $currentProg?>">
                                                <?php
                                                if (empty($currentProg)){
                                                    echo " ";
                                                }else{
                                                    $currentProg;
                                                    $finalInput = $currentProg;
                                                }
                                                foreach($divProgress as $div){
                                                ?>
                                                <ul class="">
                                                    <li><?php echo htmlentities($div);?></li>
                                                </ul>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="visualProgress col-12 col-md-6">
                        <div class="circular-progress vp-large bg-shadowmd-pb" id="circular-progress">
                            <div class="value-container">
                                0%
                            </div>
                        </div>
                        <button type="button" id="kk" class="btn btn-primary rounded-pill button-progress" data-bs-toggle="modal" data-bs-target="#exampleModal">Update Progress</button>
                        <input  type="hidden" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output">
                        <div class="row pt-3">
                            <button type="submit" name="verify" style="display: none;" id="hide" class="btn btn-success rounded-pill complete-button">Request Complete</button>
                        </div>
                    </div>
                </div>
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
                                    <label class="pb-2" for="">Select fixed vehicle problems</label><br>
                                    <!-- maoni ang repair needed sa mechanic -->
                                    <!-- <p><?php echo htmlentities($result->serviceType);?></p>  -->
                                    <?php
                                    // $regeditid=intval($_GET['regeditid']);
                                    $mechID;
                                    $cuID;
                                    $sql4="SELECT * from progressremarks where mechID=:mechID AND custID=:cuID";
                                    $query5 = $dbh->prepare($sql4);
                                    $query5->bindParam(':mechID',$mechID,PDO::PARAM_STR);
                                    $query5->bindParam(':cuID',$cuID,PDO::PARAM_STR);
                                    $query5->execute();
                                    $results=$query5->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query5->rowCount()>0){
                                        foreach($results as $res){
                                    ?>
                                    <input type="hidden" name="remarkID" value="<?php echo htmlentities($res->remarkID)?>">
                                    <?php
                                    //mao ni ang gi checkan
                                    $divide = explode(",", $res->mechRepair);
                                    //overall request sa mechanic
                                    $maoni=explode(',', $result->mechRepair);
                                    // var_dump($maoni);
                                        }
                                    }
                                    foreach($maoni as $result2){
                                        if(strcmp($result2, $divide[0] ?? null)  && strcmp($result2, $divide[1] ?? null) && strcmp($result2, $divide[2] ?? null) && strcmp($result2, $divide[3] ?? null) && strcmp($result2, $divide[4] ?? null) && strcmp($result2, $divide[5] ?? null) && strcmp($result2, $divide[6] ?? null) && strcmp($result2, $divide[7] ?? null) && strcmp($result2, $divide[8] ?? null) && strcmp($result2, $divide[9] ?? null)){
                                        ?>
                                            <input class="form-check-input testclass" type="checkbox" value="<?php echo $result2;?>" name="mechRepair[]" id="select">
                                            <label class="form-check-label" for="select"><?php echo $result2;?></label>
                                            <br>
                                        <?php
                                         }else{
                                         ?>
                                             <input class="form-check-input testclass" type="checkbox" value="<?php echo $result2;?>" name="mechRepair[]" id="select" checked >
                                             <label class="form-check-label" for="select"><?php echo $result2;?></label>
                                             <br>
                                          <?php  
                                        }
                                    }
                                    ?>
                                    <input type="hidden" id="ss">
                                    <?php
                                    ?>
                                    <?php
                                    ?>
                                    <input class="border-0 shadow-none text-end" style="background: #fff;" type="hidden" id="demo" name="output" size="1" value="<?php echo htmlentities($result->progressBar);?>" readonly> 
                                </div>
                                <hr class="divider">
                                <!-- for the inputs -->
                                <div class="col-12">
                                    <textarea class="form-control shadow-none" placeholder="Enter Remarks..." rows="3" name="latestProg" id="lprog"></textarea>
                                    <?php
                                    ?>
                                    <input type="hidden" name="remarks[]" id="finput" value="<?php echo $currentProg ?>" required>
                                    <div class="text-center">
                                        <a class="btn btn-primary rounded-pill text-center mt-2 px-5" onclick="fill()" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Update</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel2">Confirm Remarks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update remarks?
                </div>
                <div class="modal-footer">
                    <button type="sumbit" class="my-1 btn btn-primary rounded-pill" value="UpdateMe" name="UpdateMe" id="UpdateMe">Update Remarks<i class="bi bi-arrow-counterclockwise"></i></button>
  
                </div>
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
            document.getElementById("kk").style.display = "none";
            reload();
        }
    }

    var t = document.getElementById("need").value;
    if(t == "Emergency Service"){
        document.getElementById("needss").style.display = "none";
    }
    //for circular progress bar
    let progressBar = document.getElementById("circular-progress");
    let valueContainer = document.querySelector(".value-container");
    let dynamicValue = document.getElementById("output").value;

    let progressValue = 0;
    let progressEndValue = progressValue;
    let speed = 10;

    let progress = setInterval(() => {
        valueContainer.textContent = `${progressValue}%`;
        progressBar.style.background = `conic-gradient(
            #9132da ${progressValue * 3.6}deg, 
            #b68bd6 ${progressValue * 3.6}deg
        )`;
        if (progressValue == dynamicValue) {
            clearInterval(progress);
        }
        progressValue++;
    }, speed);
    // for setting progress percentage
    var totalLengthCheckbox = document.getElementsByName("mechRepair[]").length; // gikuha niya ang array length sample = 3
    // var keyy = document.getElementsByName("mechRepair[]").value;
    var dividelengthCheckbox = 100 / totalLengthCheckbox; //gi divide ang total length to 100
    function totalIt() {
        // var input = passedArray.split(",");
        var total = 0;                        
        var input = document.getElementsByName("mechRepair[]");                  
        for (var i = 0; i < input.length; i++) { 
            if (input[i].checked) {
                var total = total + dividelengthCheckbox;
            }
            document.getElementById("demo").value = total;
        }
    }
    var finp = document.getElementById("finput");
    var lprog = document.getElementById("lprog");
    let currentProg = document.getElementById("currentProg");
    var latestProg;
    var separator = "@";
    function fill(){
        if(currentProg.value.length ==0){
            finp.value = lprog.value;
            lprog.value = null;
        }else{
            latestProg = currentProg.value + separator + lprog.value;
            finp.value = latestProg; 
        } 
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