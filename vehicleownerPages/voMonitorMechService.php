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
    <?php include('voHeader.php');?>
  

    <section class="mechRequest" class="container-fluid">
         <div class="emptyrequest" hidden>
            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
            <h6>There is no mechanic nearby..</h6>
        </div>
        <form method="POST">
            <?php
                $regeditid=intval($_GET['regeditid']);
                $sql="SELECT * from request WHERE resID=:regeditid and status='Unaccepted'";
                $query=$dbh->prepare($sql);
                $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);

                if($query->rowCount()>0)
                {
                foreach ($results as $result) 
                {
            ?>
            <div class="row py-3 px-sm-0 px-md-3 text-center table-responsive justify-content-center pb-5">
                <div class="col-md-8 bg-white p-4 rounded-3 shadow-lg">
                    <div class="row text-dark">
                        <h3 class="pb-4">Request Details</h3>
                        <div class="col-sm-12 col-md-6 pb-5 justify-content-center">
                            
                            <div class="with-image"><img src="../img/avatar.jpg.jpg" class="rounded-circle imagenajud float-end" alt=""></div>
                            <div class="row py-0 pt-0" >
                                
                                <!-- <input type="text" class="border-0 text-center" name="mechName" value="<?php echo htmlentities($result->vOwnerName);?>">
                                <input type="text" class="border-0 text-center" name="Specialization" value="<?php echo htmlentities($result->custAddress);?>"> -->
                                <iframe src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed" frameborder="0" width="700" height="400">
                                </iframe>
                            </div>                       
                        </div>
                        <div class="col-sm-12 col-md-6 text-start">
                                <h5 class="text-start">Vehicle Owner Information</h6>
                                <p><?php echo htmlentities($result->vOwnerName);?></p>
                                <h5 class="text-start mt-2">Request Information</h5>
                                <p><i>Service Needed:</i> <?php echo htmlentities($result->serviceNeeded);?></p> 
                                <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                                <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?> <?php echo htmlentities($result->time);?></p>
                                <p class="pb-2"><i>Vehicle Problem:</i> <?php echo htmlentities($result->mechRepair);?></p>
                                <h5>Noted Message</h5>
                                <p><?php echo htmlentities($result->specMessage);?></p>
                               
                                <!-- <input type="text" class="border-0 text-center" name="Specialization" value="<?php echo htmlentities($result->serviceType);?>">
                                <input type="text" class="border-0 text-center" name="mechAddress" value="<?php echo htmlentities($result->serviceNeeded);?>">
                                <input type="text" class="border-0 text-center" name="mechAddress" value="<?php echo htmlentities($result->mechRepair);?>">
                                <input type="text" class="border-0 text-center" name="mechAddress" value="<?php echo htmlentities($result->specMessage);?>"> -->
                                <div class="py-2">
                                    <label for="">Leave a message</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Leave a message before accepting. . ." rows="3" name="specMessage" value="specMessage" required></textarea>
                                </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-6 d-grid pb-2"><button class="btn btn-primary rounded-pill" name="Accept" value="Accept">Accept</button></div>
                        <div class="col-md-6 d-grid pb-2"> <button class="btn btn-secondary rounded-pill boton" type="button"><a href="./voCarmech.php">Decline</a></button></div>
                    </div>
                </div>
            </div>
            <?php }}?>
        </form>

    </section>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>