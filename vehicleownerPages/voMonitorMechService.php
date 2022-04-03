<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
if(isset($_POST["confirm"])){
    $resID=intval($_POST['resID']);
     $sql1="UPDATE request set status='confirmed' WHERE resID=:resID"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
     $query=$dbh->prepare($sql1);
     $query->bindParam(':resID',$resID,PDO::PARAM_STR);
     $query->execute(); 
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

<body id="contbody" style="background-color: #f8f8f8">
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
                    <h5 class="text-start">Monitor Mechanic Services</h6>
                        <p><?php echo htmlentities($result->vOwnerName);?></p>
                        <h5 class="text-start mt-2">Request Information</h5>
                        <h1 class="text-end pl-5">51%</h1>
                        <p><i>Service Needed:</i> <?php echo htmlentities($result->serviceNeeded);?></p>
                        <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                        <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?>
                            <?php echo htmlentities($result->time);?></p>
                        <p class="pb-1 "><i>Vehicle Problem:</i> <?php echo htmlentities($result->mechRepair);?></p>
                        <h5>Noted Message</h5>
                        <p class="line-segment"><?php echo htmlentities($result->specMessage);?></p>

                        <p class="py-3">Please Update the progress bar so that your client know the status of his/her
                            request.</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div> 
                         <button class="my-2 btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i></button>
                        <div class="row p-2 d-flex align-self-end justify-content-end">
                            <p class="pb-3">Make sure to complete the request before clicking the button.</p>
                            <a class="btn btn-primary col-md-4 rounded-pill" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Request Complete</a>
                        </div>
                    </div> 
                </div>
            </div>
            <?php $cnt=$cnt+1;}}?>
            <div class="modal fade text-dark" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Are you sure you want to end the service?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                       <i class="fa-solid fa-triangle-exclamation text-danger"></i> Check the vehicle if it is 100% fixed. <br>
                       <a class="btn btn-primary rounded-pill shadow-none mt-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Continue</a>
                       <button type="button" class="btn btn-secondary rounded-pill shadow-none mt-3" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                       <!-- <a class="btn btn-secondary rounded-pill shadow-none mt-3" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</a> -->
                    </div>
                    <!-- <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Continue</button>
                    </div> -->
                    </div>
                </div>
                </div>
                <div class="modal fade text-dark" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Rate Mechanic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body star">
                        <!-- rate -->
                        <div class="container">
                            <span id="rateMe1"></span>
                        </div>
                        <div class="star-widget">
                            <input type="radio" name="rate" id="rate-5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1">
                            <label for="rate-1" class="fas fa-star"></label>
                            <form action=""></form>
                        </div>
                        <div class="mt-2">
                            <label for="">Leave a Feedback</label>
                            <textarea class="form-control shadow-none" id="exampleFormControlTextarea1" rows="3" name="specMessage" value="specMessage"></textarea>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button>
                    </div> -->
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
      const btn = document.querySelector("button");
      const post = document.querySelector(".post");
      const widget = document.querySelector(".star-widget");
      const editBtn = document.querySelector(".edit");
      btn.onclick = ()=>{
        widget.style.display = "none";
        post.style.display = "block";
        editBtn.onclick = ()=>{
          widget.style.display = "block";
          post.style.display = "none";
        }
        return false;
      }
    </script>                           
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/addons/rating.js"></script>
</body>

</html>