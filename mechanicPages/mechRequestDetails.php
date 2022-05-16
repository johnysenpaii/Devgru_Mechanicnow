<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(isset($_POST['Accept']))
{
    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set status='Accepted' where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();

    $custID = $_POST['custID'];
    $mechID = $_POST['mechID'];
    $custName = $_POST['custName'];
    $mechName = $_POST['mechName'];
    $specMessage = $_POST['specMessage'];
    $role = $_POST['role'];
    // $vehicleProblem = $_POST['vehicleProblem'];

    $sql4 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID, :mechID, 'Accepted')";
    $query4 = $dbh->prepare($sql4);
    $query4->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query4->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query4->execute();

    $sql3 = "INSERT INTO progressremarks(custID, mechID)VALUES(:custID, :mechID)";
    $query5 = $dbh->prepare($sql3);
    $query5->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query5->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query5->execute();

    $sql2 = "INSERT INTO chat(custID, mechID, custName, mechName, message, role) VALUES(:custID, :mechID, :custName, :mechName, :specMessage, :role)";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query2->bindParam(':custName',$custName,PDO::PARAM_STR);
    $query2->bindParam(':mechName',$mechName,PDO::PARAM_STR);
    $query2->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
    $query2->bindParam(':role',$role,PDO::PARAM_STR);
    $query2->execute();
    echo"<script type='text/javascript'>alert('Accepted Successfully!');</script>";
    echo"<script>location.replace('./mechDashboard.php');</script>";

}
if(isset($_POST['Decline']))
{
    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set status='Decline' where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();

    $custID = $_POST['custID'];
    $mechID = $_POST['mechID'];


    $sql0 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID, :mechID, 'Decline')";
    $query0 = $dbh->prepare($sql0);
    $query0->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query0->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query0->execute();
}
$mechID1=$_SESSION['mechID'];
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
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body id="contbody" style="background-color: #f8f8f8">
    <?php include('./mechHeader.php');?>

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

                if($query->rowCount()>0){
                    foreach ($results as $result){
            ?>
            <div class="container-fluid p-0">
                <div class="row m-0 p-0">
                    <iframe class="col-12 col-md-8" src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed" frameborder="0" style="height: 90vh;padding: 0px"></iframe>
                    <div class="col-12 col-sm-4 m-0 info-panel shadow-lg p-3" style="background-color: #fff">
                        <div class="row align-items-center">
                            <div class="col-3 mx-3 with-image" style="width: 100px; padding: 5px;">
                                <img src="../img/vo.jpg" class="float-center imagenajud" alt="" style="max-width: 100%; height: 90px; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div class="mech-inforeq col-7">
                                <h4><input readonly type="text" class="border-0 no-shadow shadow-none mt-2" name="custName" value="<?php echo htmlentities($result->vOwnerName);?>"></h4>
                                <!-- <input type="hidden" id="starss" value="<?php //echo htmlentities($result->average);?>">
                                <span type="text" id="stars" onload="getStars()" name="total"></span><br> -->
                                <!-- <input readonly type="text" class="border-0 m-info " size="30" name="vehicleType" value="<?php //echo htmlentities($result->vehicleType);?>"><br>
                                <input readonly type="text" class="border-0 m-info" size="30" name="Specialization" value="<?php //echo htmlentities($result->Specialization);?>"> -->
                            </div>
                        </div>
                        
                        <input type="text" name="custName" value="<?php echo htmlentities($result->vOwnerName);?>" hidden> 
                        <input type="text" name="mechName" value="<?php echo htmlentities($result->mechName);?>" hidden>
                        <input id="address" name='latitude' value="<?php echo htmlentities($_SESSION["latitude"]); ?>" hidden>
                        <input id="address" name='longitude' value="<?php echo htmlentities($_SESSION["longitude"]); ?>" hidden>
                        <input type="hidden" name="role" value="sender">
                        <hr class="divider divider2">
                        <div class="request-form" style="color: #302D32">
                            <div class="request-content text-start">
                                <span class="sub-title">Requested Service from vehicle owner.</span>
                                <div class="form-check text-start pt-1">
                                    <input readonly type="text" class="border-0 m-info" size="30" name="service" value="<?php echo htmlentities($result->serviceNeeded);?>">
                                </div>
                                <div id="needs" style="display: none;">
                                    <p class="px-4">Date: <?php echo htmlentities($result->date);?></p>
                                    <p class="px-4">Time: <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?> <?php echo htmlentities($result->time);?></p>
                                </div>
                                <!-- <div id="needs">
                                    <p class="px-4">Date: <?php //echo htmlentities($result->date);?></p>
                                    <p class="px-4">Time: <?php //echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?></p>
                                </div> -->
                                <div class="py-2">
                                    <span class="sub-title">Vehicle owner problem.</span></br>
                                    <div class="py-1"><?php echo htmlentities($result->mechRepair);?></div>
                                </div>
                                <div class="alert alert-primary text-start py-0 pb-1 mb-0 note-alert shadow-sm">
                                    <div class="row">
                                        <div class="iconlabel">
                                            <i class="fa-solid fa-circle-exclamation col-1"></i>
                                            <p>Noted Message</p>
                                        </div>
                                        <p class="col-10 col-sm-11 py-1 specmessage">
                                            <?php echo htmlentities($result->specMessage);?>
                                        </p>
                                    </div>
                                </div>
                                <!-- <span class="sub-title">Noted Message</span>
                                <p><?php echo htmlentities($result->specMessage);?></p> -->
                                <input type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>" hidden>
                                <input type="text" name="custID" value="<?php echo htmlentities($result->custID);?>" hidden>
                                <div class="py-2">
                                    <label for="">Leave a message</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Leave a message before accepting. . ." rows="3" name="specMessage" value="specMessage" required></textarea>
                                </div>
                                <input type="hidden" name="role" value="receiver">
                            </div>
                        </div>
                        <div class="row request-buttons">
                            <div class="col-md-6 d-grid "><button type="submit" class="btn btn-primary rounded-pill shadow border-0" name="Accept" value="Accept">Accept</button></div>
                            <div class="col-md-6 d-grid "> <button class="btn btn-secondary rounded-pill shadow border-0" type="submit" name="Decline">Decline</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal for confirmation -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close border-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <?php
                            $regeditid=intval($_GET['regeditid']);
                            $sql="SELECT * from mechanic WHERE mechID=:regeditid";
                            $query=$dbh->prepare($sql);
                            $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
                            $query->execute();
                            $results=$query->fetchALL(PDO::FETCH_OBJ);

                            if($query->rowCount()>0){
                                foreach ($results as $result){
                        ?>
                        Are you sure to send a request to <?php echo htmlentities($result->mechFirstname." ".$result->mechLastname)?>?
                        <?php }}?>
                        <div class="pt-5">
                            <button type="submit" class="btn btn-primary rounded-pill shadow" name="send" value="send">Submit Request</button>
                            <button type="button" class="btn btn-secondary rounded-pill shadow" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <?php }}?>
            <input hidden type="text" id="latitude" name="latitude"
                value="<?php echo htmlentities($_SESSION["latitude"]); ?> ">
            <input hidden type="text" id="longitude" name="longitude"
                value=" <?php echo htmlentities($_SESSION["longitude"]); ?>">
        </form>
        <!-- <form method="POST">
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
                                <iframe src="https://maps.google.com/maps?q=<?php echo htmlentities($result->latitude);?>,<?php echo htmlentities($result->longitude);?>&<?php echo htmlentities($_SESSION['latitude']);?>,<?php echo htmlentities($_SESSION['longitude']);?>&output=embed" frameborder="0" width="700" height="400">
                                </iframe>
                            </div>                       
                        </div>
                        <div class="col-sm-12 col-md-6 text-start">
                                <h5 class="text-start">Vehicle Owner Information</h6>
                                <p><?php echo htmlentities($result->vOwnerName);?></p>
                                <input type="text" name="custName" value="<?php echo htmlentities($result->vOwnerName);?>" hidden> 
                                <input type="text" name="mechName" value="<?php echo htmlentities($result->mechName);?>" hidden> 
                                <h5 class="text-start mt-2">Request Information</h5>
                                <input disabled class="border-0 bg-white py-2" type="text" id="need" value="<?php echo htmlentities($result->serviceNeeded);?>">
                              
                                <div id="needs" style="display: none;">
                                    <p><i>Date:</i> <?php echo htmlentities($result->date);?></p>
                                    <p><i>Time:</i> <?php echo htmlentities($result->time) < 12 ? 'AM' : 'PM';?> <?php echo htmlentities($result->time);?></p>
                                </div>
                                <p class="pb-2"><i>Vehicle Problem:</i> <?php echo htmlentities($result->mechRepair);?></p>
                                <h5>Noted Message</h5>
                                <p><?php echo htmlentities($result->specMessage);?></p>
                               
                                <input type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>" hidden>
                                <input type="text" name="custID" value="<?php echo htmlentities($result->custID);?>" hidden>
                                <div class="py-2">
                                    <label for="">Leave a message</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Leave a message before accepting. . ." rows="3" name="specMessage" value="specMessage" required></textarea>
                                </div>
                                <input type="hidden" name="role" value="receiver">
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-6 d-grid pb-2"><button class="btn btn-primary rounded-pill" name="Accept" value="Accept">Accept</button></div>
                        <div class="col-md-6 d-grid pb-2"> <button class="btn btn-secondary rounded-pill boton" type="submit" name="Decline">Decline</button></div>
                    </div>
                </div>
            </div>
            <?php }}?>
        </form> -->
    </section>
    <script>
        var t = document.getElementById("need").value;
        if(t == "Home Service")
        {
            document.getElementById("needs").style.display = "block";
        }
    </script>
    <script src="js/main.js"></script>
</body>
</html>
