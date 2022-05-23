<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
if(isset($_POST["confirm"]) || isset($_POST['comment'])){
    $regeditid=intval($_GET['regeditid']);
      $value00=$_POST['value'];
     $sql1="UPDATE request set status='Complete',ratePercentage=:value00,Edate=CURRENT_TIMESTAMP() WHERE resID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
     $query=$dbh->prepare($sql1);
     $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
     $query->bindParam(':value00',$value00,PDO::PARAM_STR);
     $query->execute(); 
     echo "<script type='text/javascript'>document.location='voActivityLog.php';</script>";
     
     $mechID=$_POST['mechID'];
     $custID=$_SESSION['custID'];
     $sql4 = "INSERT INTO notification(custID, mechID, status) VALUES(:custID, :mechID, 'Complete')";
     $query4 = $dbh->prepare($sql4);
     $query4->bindParam(':custID',$custID,PDO::PARAM_STR);
     $query4->bindParam(':mechID',$mechID,PDO::PARAM_STR);
     $query4->execute();

   }
   if(isset($_POST["comment"])){
    $custID=$_SESSION['custID'];
    $mechID=$_POST['mechID'];
    $value00=$_POST['value'];
    $mechName1 = $_POST['mechName1'];
    $specMessage=$_POST['specMessage'];
    $sql="INSERT INTO ratingandfeedback(custID,mechID,feedback,ratePercentage, mechName)VALUES(:custID, :mechID, :specMessage,:value00, :mechName1)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
    $query->bindParam(':value00',$value00,PDO::PARAM_STR);
    $query->bindParam(':mechName1',$mechName1,PDO::PARAM_STR);
    $query->execute();
}
if(empty($_SESSION['custID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['custID']);
      }
      if(isset($_POST["logout"])) { 
        unset($_SESSION['custID']);
        session_destroy();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
    <style>
        .star .star-widget input{
        text-align: center;
        display: none;
        }
        .star-widget label{
        font-size: 20px;
        color: #444;
        padding: 10px;
        float: right;
        transition: all 0.2s ease;
        }
        input:not(:checked) ~ label:hover,
        input:not(:checked) ~ label:hover ~ label{
        color: #9132DA;
        }
        input:checked ~ label{
        color: #9132DA;
        }
        input#rate-5:checked ~ label{
        color: #9132DA;
        text-shadow: 0 0 20px #952;
        }
        #rate-1:checked ~ form header:before{
        content: "I just hate it ";
        }
        #rate-2:checked ~ form header:before{
        content: "I don't like it ";
        }
        #rate-3:checked ~ form header:before{
        content: "It is awesome ";
        }
        #rate-4:checked ~ form header:before{
        content: "I just like it ";
        }
        #rate-5:checked ~ form header:before{
        content: "I just love it ";
        }
    </style>
</head>

<body id="contbody" style="background-color: #f8f8f8" onload="verify()">
    <?php include('voHeader.php');?>
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
            <div class="row info-request">
                <h2 style="color: #302d32">Monitor Mechanic Services</h2>
                <div class="info-row col-12 col-md-6">
                    <input type="hidden" name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                    <input type="hidden" name="status" id="status" value="<?php echo htmlentities($result->status);?>">
                    <input type="hidden" value="<?php echo htmlentities($result->progressBar);?>">
                    <p>Mechanic: <?php echo htmlentities($result->mechName);?></p>
                    <p>Service Request: <?php echo htmlentities($result->serviceNeeded);?></p>
                    <p>Vehicle Problem: <?php echo htmlentities($result->mechRepair);?></p>
                    <p>Date: <?php echo htmlentities($result->date);?></p>
                    <p>Time: <?php echo htmlentities($result->timess);?> <?php echo htmlentities($result->timess) < 12 ? 'AM' : 'PM';?></p>
                    <!-- <a class="btn btn-primary col-md-4 rounded" id="btnm" style="display: none;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">End service</a> -->
                    <div class="prog-wap col-12 mt-4">
                    <h5 class="text-center">PROGRESS</h5>
                    <div class="visualProgress visual-prog2 row">
                        <div class="circular-progress col-12 col-md-8 col-lg-12" id="circular-progress">
                           <div class="value-container">
                                0%
                            </div>
                        </div>
                        <div class="legendcolumn col-12 col-md-7 col-lg-6">
                            <div class="legenddesc">
                                <div class="legend-box1"></div>
                                <p>On-going progress</p>
                            </div>
                            <a type="button" class="btn btn-primary rounded-pill button-progress" id="btnm" style="display: none;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Complete</a> 
                            <input  type="hidden" class="border-0"  value="<?php echo htmlentities($result->progressBar);?>" id="output">
                            <input  type="hidden" class="border-0" name="mechName1" value="<?php echo htmlentities($result->mechName);?>">
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="remarks-wrap col-12 col-md-5">
                    <h5 class="text-center py-3">REMARKS</h5>
                    <div class="rwrap">
                        <?php 
                            $mechID = $result->mechID;
                            $custID1;
                            $sql4="SELECT * from progressremarks where mechID=:mechID AND custID=:custID1 order by remarkID DESC limit 1";
                            $query5 = $dbh->prepare($sql4);
                            $query5->bindParam(':mechID',$mechID,PDO::PARAM_STR);
                            $query5->bindParam(':custID1',$custID1,PDO::PARAM_STR);
                            $query5->execute();
                            $results=$query5->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                                if($query5->rowCount()>0){
                                    foreach($results as $res){
                                        $remark = explode("@", $res->remarks);
                                        foreach($remark as $res){
                                            if($res !== null){
                        ?>
                        <hr>
                        <p class="indiv-remark"><?php echo htmlentities($res)?></p>
                        <?php
                        }else{
                        ?>
                        <p class="text-center">Theres No Remarks Yet</p>
                        <?php }}}}?>
                        <hr>
                    </div>
                </div>
            </div>
            <?php $cnt=$cnt+1;}}?>
            <div class="modal fade text-dark" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Are you sure you want to end the service?</h5>
                    </div>
                    <div class="modal-body text-center">
                       <i class="fa-solid fa-triangle-exclamation text-danger"></i> Check the vehicle if it is 100% fixed. <br>
                       <a class="btn btn-primary rounded-pill shadow-none mt-3" type="submit"  data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" onclick="modalShow()" data-bs-dismiss="modal">Continue</a>
                       <button type="button" class="btn btn-secondary rounded-pill shadow-none mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
             
                    </div>
                    </div>
                </div>
                </div>
                <div class="modal fade text-dark" id="exampleModalToggle2" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Rate Mechanic</h5>
                        <button type="submit" name="confirm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body star">
                        
                        <div class="star-widget">
                            <input type="radio" name="rate" id="rate-5" value="5"><label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4" value="4"><label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3" value="3"><label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2" value="2"><label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1" value="1"><label for="rate-1" class="fas fa-star"></label>
                            <form action=""></form>
                        </div>
                       <input type="hidden" name="value" id="value" value="">
                        <div class="mt-2">
                            <label for="">Leave a Feedback</label>
                            <textarea class="form-control shadow-none" id="exampleFormControlTextarea1" rows="3" name="specMessage" value="specMessage"></textarea>
                        </div>
                        <div class="btn-center">
                            <button class="btn btn-primary my-1 text-center" name="comment" type="sumbit">Submit</button>
                        </div>
                    
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
    
    let star = document.getElementsByName('rate');
    let showValue = document.getElementById('value');

    for (let i = 0; i < star.length; i++) {
	star[i].addEventListener('click', function() {
		i = this.value;

		showValue.value = i;
	});
    }
    function verify(){
        var t = document.getElementById("status").value;
        if(t == "verify"){
            document.getElementById("btnm").style.display = "block";
        }
    }
    function preventBack(){window.history.forward();}
        setTimeout("preventBack()",0);
        window.onunload = function(){ null };

    function modalShow(){
        document.getElementById("exampleModalToggle2").style.display="block";

    }
    //for circular progress bar
    let progressBar = document.getElementById("circular-progress");
    let valueContainer = document.querySelector(".value-container");
    let dynamicValue = document.getElementById("output").value;

    let progressValue = 0;
    let progressEndValue = 100;
    let speed = 20;

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
    </script>                           
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/addons/rating.js"></script>
</body>

</html>
