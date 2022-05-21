<?php
session_start();
include('../config.php');
$mechID1=$_SESSION['mechID']; 

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
    $demo = $_POST['demo'];
 
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
 

 


$sql12="INSERT INTO progressremarks(mechID, custID, remarks) 
values (:mechID1, :custID , :demo)";
$query12=$dbh->prepare($sql12);
$query12->bindParam(':mechID1',$mechID1,PDO::PARAM_STR);
$query12->bindParam(':custID',$custID,PDO::PARAM_STR);
$query12->bindParam(':demo',$demo,PDO::PARAM_STR);
$query12->execute();


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

  $sql13="UPDATE mechanic set status='approve' where mechID=:mechID1";
  $query13=$dbh->prepare($sql13); 
  $query13->bindParam(':mechID1',$mechID1,PDO::PARAM_STR); 
  $query13->execute();
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
                        <p class="fw-bold" style="font-size: 20px;">Vehicle Problem:</p>   

                          
                        <?php
                        
                        foreach(explode(',', $result->mechRepair) as $ing) { 
                          
                                ?>
                           <input class="<?php echo htmlentities($ing)?>" onclick="totalIt()" type="checkbox" id="box" name="lenghtCheckbox" value="" <?php echo ($ing == $ing ? 'checked' : '');?>> <label for="box"><?php echo htmlentities($ing)?></label> <br>
                        <?php  }?>
                    <input class="display-6 fw-bold" name="demo" id="demo" value="0"></input>
                    <div id="msg"></div>
                        <h5>Noted Message</h5>
                        <p class="line-segment"><?php echo htmlentities($result->specMessage);?></p>

                        <p class="py-2"><em>Click the progress bar and update to let your client know the status of his/her
                                request.</em></p>
                        <progress id="file" style="height:50px; width: 620px;" value="<?php echo htmlentities($result->progressBar);?>" max="100"></progress>
                        <button type="sumbit" class="my-2 btn btn-primary rounded-pill" value="UpdateMe" name="UpdateMe" id="UpdateMe">Update me <i class="bi bi-arrow-counterclockwise"></i></button>
                        <input  type="text" name="output" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output">

                        <!-- <div class="progress" style="height: 25px;" onclick="increase()">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress"
                            role="progressbar"><?php echo htmlentities($result->progressBar);?>%</div>
                </div> -->
                        <!-- <button value="UpdateMe" name="UpdateMe" type="submit" class="my-4 btn btn-primary rounded-pill">Update me <i class="bi bi-arrow-counterclockwise"></i></button> -->
                        <!-- <input name="tb" value="<?php echo htmlentities($result->progressBar);?>" type="text" id="tb">  -->
                        <div class="row pt-5 d-flex align-self-end justify-content-end">
                            <button type="submit" name="verify" style="display: none;" id="hide" class="btn btn-primary col-md-4 rounded-pill">Request Complete</button>
                        </div>
                </div>
            </div>
            <?php $cnt=$cnt+1;}}?>
        </form>
    </section>
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

var totalLenghtCheckbox = document.getElementsByName("lenghtCheckbox").length;
var dividelenghtCheckbox= 100 / totalLenghtCheckbox;
for (let i = 0; i < totalLenghtCheckbox; i++)
{
	document.getElementsByName("lenghtCheckbox")[i].value = dividelenghtCheckbox;
}

function totalIt() {
  var input = document.getElementsByName("lenghtCheckbox");
  var total = 0;
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked) {
      total += parseFloat(input[i].value);
    }
  }
document.getElementById("demo").value = total.toFixed(2) + " %";
}
    var t = document.getElementById("need").value;
        if(t == "Home Service")
        {
            document.getElementById("needs").style.display = "block";
        }
     
// const list = document.getElementById("box").value;

// for (const checkbox of document.querySelectorAll("#box[name=lenghtCheckbox]")) {
//   if (list.includes(String(checkbox.value))) {
//     checkbox.checked = true;
//   }
// }  
    </script>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
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