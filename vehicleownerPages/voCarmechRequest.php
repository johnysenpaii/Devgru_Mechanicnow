<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$custAddress1=$_SESSION['custAddress'];
$custID1=$_SESSION['custID'];

if(isset($_POST['send'])){  
    $host="localhost";
    $username="root"; 
    $word="";
    $db_name="mechanicnowdb"; 
    $tbl_name="request"; 
    $con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  
    $mechName=$_POST['mechName']; 
    $Specialization=$_POST['Specialization'];
    $mechAddress=$_POST['mechAddress'];
    $custAddress=$_POST['custAddress'];
    $specMessage=$_POST['specMessage'];
    $checkbox1=$_POST['mechRepair'];  
    $vOwnerName=$_POST['vOwnerName'];
    $service=$_POST['service'];
    $mechID=$_POST['mechID'];
<<<<<<< Updated upstream
    $chk=""; 
    $spec="";
    $mechN="";
    $vON="";
    $mID="";
    $Specl="";
    $mechAdd="";
    $custAdd="";
    $serv="";
    foreach($checkbox1 as $chk1){  
        $chk .= $chk1.", ";
=======
    $date=$_POST['date'];
    $time=$_POST['time'];
    $custID=$_SESSION['custID'];
    
    $sql7 = "INSERT INTO notification(custID, mechID) VALUES(:custID, :mechID)";
    $query7 = $dbh->prepare($sql7);
    $query7->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query7->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query7->execute();
    
    // $currentlocation=$_POST['currentlocation'];
    if(isset($_POST["mechRepair"])){
        $mechRepairInsert = implode(',', $_POST['mechRepair']);
    }
    if(empty($mechRepairInsert)){
         echo "<script>alert('Please select vehicle problem')</script>";
    }else{
        try{
            if(!isset($errorMsg)){


  $sql12="INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, serviceNeeded, mechID, custID, latitude, longitude, date, timess) 
  values (:mechName, :voName, :specMessage, :mechRepairInsert, :Specialization, :service,:mechID ,:custID ,:latitude , :longitude, :date, :time)";
  $query12=$dbh->prepare($sql12);
  $query12->bindParam(':mechName',$mechName,PDO::PARAM_STR);
  $query12->bindParam(':voName',$voName,PDO::PARAM_STR);
  $query12->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
  $query12->bindParam(':mechRepairInsert',$mechRepairInsert,PDO::PARAM_STR);
  $query12->bindParam(':Specialization',$Specialization,PDO::PARAM_STR);
  $query12->bindParam(':service',$service,PDO::PARAM_STR);
  $query12->bindParam(':latitude',$latitude,PDO::PARAM_STR);
  $query12->bindParam(':longitude',$longitude,PDO::PARAM_STR);
  $query12->bindParam(':custID',$custID,PDO::PARAM_STR);
  $query12->bindParam(':mechID',$mechID,PDO::PARAM_STR);
  $query12->bindParam(':date',$date,PDO::PARAM_STR);
  $query12->bindParam(':time',$time,PDO::PARAM_STR);
  $query12->execute();
  $msg='Request success!!';
  header("Location:voActivityLog.php?/requestForm=$msg");
}
else{
    $msgFailed = 'Request Failed!!';
    header("Location:voCarMechRequest.php?/requestForm=$msgFailed");
}
}
catch(PDOException $e){
    echo $e->getMessage();
}
}

    
            // $role = $_POST['role']; 
            // $custID = $_SESSION['custID']; 
            // $custName = $_POST['custName'];
           

            // $sql2 = "INSERT INTO chat(custID, mechID, custName, mechName, message, role) VALUES(:custID, :mechID, :custName, :mechName, :specMessage, :role)";
            // $query2 = $dbh->prepare($sql2);
            // $query2->bindParam(':custID',$custID,PDO::PARAM_STR);
            // $query2->bindParam(':mechID',$mechID,PDO::PARAM_STR);
            // $query2->bindParam(':custName',$custName,PDO::PARAM_STR);
            // $query2->bindParam(':mechName',$mechName,PDO::PARAM_STR);
            // $query2->bindParam(':specMessage',$specMessage,PDO::PARAM_STR);
            // $query2->bindParam(':role',$role,PDO::PARAM_STR);
            // $query2->execute();
>>>>>>> Stashed changes
    } 
    $spec .= $specMessage;  
    $mechN .= $mechName;
    $vON .= $vOwnerName;
    $mID .= $mechID;
    $Specl .= $Specialization;
    $mechAdd .= $mechAddress;
    $custAdd .= $custAddress;
    $serv .= $service;

    $in_ch=mysqli_query($con,"INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, serviceNeeded, mechID, custID, mechAddress, custAddress) values ('$mechN', '$vON' , '$spec', '$chk', '$Specl', '$serv', '$mID', '$custID1', '$mechAdd', '$custAdd')");  
    if($in_ch==1)  
    {  
        echo'<script>alert("Request Sent Successfully, Wait for Mechanic to Confirm!")</script>';  
        echo"<script>location.replace('voDashboard.php');</script>";  
    }  
    else  
    {  
        echo'<script>alert("Failed to Send Request")</script>';  
    }  
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
    <title>Mechanic Now</title>
    <link rel="shortcut icon" type="x-icon" href="../img/mechanicnowlogo.svg">
</head>
<body id="contbody" style="background-color: #f8f8f8">
    <?php include('voHeader.php');?>
    <?php include('./voTopnav.php');?>

    <section class="mechRequest" class="container-fluid">
         <div class="emptyrequest" hidden>
            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
            <h6>There is no mechanic nearby..</h6>
        </div>
        <form method="POST">
            <?php
                $regeditid=intval($_GET['regeditid']);
                $sql="SELECT * from mechanic WHERE mechID=:regeditid";
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
                        <h3 class="pb-4">Request Form</h3>
                        <div class="col-sm-12 col-md-6 pb-5 justify-content-center">
                            <h6 class="text-start">Mechanic Information</h6>
                            <div class="with-image"><img src="../img/avatar.jpg.jpg" class="rounded-circle imagenajud float-end" alt=""></div>
                            <div class="row py-1" >
                                <input type="text" class="border-0 text-center" name="mechName" value="<?php echo htmlentities($result->mechFirstname." ".$result->mechLastname);?>">
                                <input type="text" class="border-0 text-center" name="Specialization" value="<?php echo htmlentities($result->Specialization);?>">
                                <input type="text" class="border-0 text-center" name="mechAddress" value="<?php echo htmlentities($result->mechAddress);?>">
                                <input hidden type="text" name="vOwnerName" value="<?php echo htmlentities($_SESSION["custFirstname"]); ?> <?php echo htmlentities($_SESSION["custLastname"]); ?>">
                                <input hidden type="text" name="custAddress" value="<?php echo htmlentities($_SESSION["custAddress"]); ?>">
                                <input hidden type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 text-start">
                            <p>If you want a long term service, select Home Service. Select Emergency service if you are on-road.</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="Home Service" name="service" id="exampleRadios1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Home Service
                                </label>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input" type="radio" value="Emergency Service" name="service" id="exampleRadios2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Emergency Service
                                </label>
                            </div>
<<<<<<< Updated upstream
                            <h6><i>Please select and/or specify mechanical problem below.</i></h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="mechRepair[]" value="Tire Repair">
                                <label class="form-check-label" for="flexCheckDefault">Tire Repair</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault"  name="mechRepair[]" value="Engine Overheat Repair">
                                <label class="form-check-label" for="flexCheckDefault">Engine Overheat Repair</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="mechRepair[]" value="Dead Battery Repair">
                                <label class="form-check-label" for="flexCheckDefault">Dead Battery Repair</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="mechRepair[]" value="Break Repair">
                                <label class="form-check-label" for="flexCheckDefault">Break Repair</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="mechRepair[]" value="Dead Light Repair">
                                <label class="form-check-label" for="flexCheckDefault">Dead Light Repair</label>
                            </div>
                             <div class="">
                                 <label for="">Others specify..</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Please specify" rows="3" name="specMessage" value="specMessage"></textarea>
=======
                        </div>
                        <div class="row request-buttons">
                            <div class="col-md-6 d-grid "><a
                                    class="btn btn-primary rounded-pill shadow border-0" id="trap"
                                    onclick="trappings()">Request</a></div>
                            <div class="col-md-6 d-grid "> <button
                                    class="btn btn-secondary rounded-pill shadow border-0" type="button"><a
                                        href="./voCarmech.php">Back</a></button></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal for confirmation -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="btn-close border-0" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                            Are you sure to send a request to
                                    
                            <?php echo htmlentities($result->mechFirstname." ".$result->mechLastname)?>
                            <?php }}?>
                            <div class="pt-5">
                                <button type="submit" class="btn btn-primary rounded-pill shadow" name="send"
                                    value="send">Submit Request</button>
                                <button type="button" class="btn btn-secondary rounded-pill shadow"
                                    data-bs-dismiss="modal">Close</button>
>>>>>>> Stashed changes
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-6 d-grid pb-2"><button class="btn btn-primary rounded-pill" name="send" value="send">Request</button></div>
                        <div class="col-md-6 d-grid pb-2"> <button class="btn btn-secondary rounded-pill boton" type="button"><a href="./voCarmech.php">Back</a></button></div>
                    </div>
                </div>
            </div>
            <?php }}?>
        </form>

    </section>

    <!-- <section id="mechContent" class="mech-content container-fluid">
        <div class="emptyrequest" hidden>
            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
            <h6>There is no mechanic nearby..</h6>
        </div>
        <div class="row py-3 px-sm-0 px-md-3 text-center table-responsive justify-content-center pb-5">
            <div class="col-lg-8 bg-white py-4 rounded-3 shadow-lg">
                <h4 class="text-dark pb-4">Request Details</h4>
            </div>

        
        <section>
        <form method="POST">
        <?php
              $regeditid=intval($_GET['regeditid']);
              $sql="SELECT * from mechanic WHERE mechID=:regeditid";
              $query=$dbh->prepare($sql);
              $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result) 
              {
        ?>
        <div class="container">
            <h1>Request Information</h1>
            <div class="mechanic-table" style="overflow-y:auto;">
                <h3>Mechanic</h3>
                <br>
                <div class="avatar-img"><img src="img/avatar.png" alt=""></div>
                <label>Name: </label>
                <input class="textin" type="text" name="mechName"  value="<?php echo htmlentities($result->mechFirstname);?> <?php echo htmlentities($result->mechLastname);?>" readonly required>
                <br>
                <label>Specialization: </label>
                <input class="textin" type="text" name="Specialization"  value="<?php echo htmlentities($result->Specialization);?>" readonly required>
                <br>
                <label>Address: </label>
                <input class="textin" type="text" name="mechAddress"  value="<?php echo htmlentities($result->mechAddress);?>" readonly required>
                <br>
                <label>Rating:</label>
                <input class="textin" type="text" name="" placeholder="Rating here"  value="" readonly required>
                <p></p>
                <input hidden type="text" name="vOwnerName" value="<?php echo htmlentities($_SESSION["custFirstname"]); ?> <?php echo htmlentities($_SESSION["custLastname"]); ?>">
                <input hidden type="text" name="custAddress" value="<?php echo htmlentities($_SESSION["custAddress"]); ?>">
                <input hidden type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>">
            </div>
            <div class="mechanic-table" style="overflow-y:auto;">
                <h3>Mechanical Problem</h3>
                <br>
                <label>Home Service</label>
                <input type="radio" value="Home Service" name="service">
                <label>Emergency Service</label>
                <input type="radio" value="Emergency Service" name="service">
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Tire Repair">
                <label>Tire Repair</label>
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Engine Overheat Repair">
                <label>Engine Overheat Repair</label>
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Dead Battery Repair">
                <label>Dead Battery Repair</label>
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Break Repair">
                <label>Break Repair</label>
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Dead Light Repair">
                <label>Dead Light Repair</label>
                <p></p>
                <br>
                <label style="margin-left: 20px">Others Specify</label>
                <br>
                <textarea placeholder="Specify here..." name="specMessage" value="specMessage" style="padding: 30px; font-size: 12px; font-family: var(--ff-primary);"></textarea>
                <br>
                <br>
                <button name="send" value="send" style="color: rgb(156, 28, 150); border-radius: 8%; padding: 10px; font-size: 16px"> Send</button>
                <button style="color: rgb(156, 28, 150); border-radius: 8%; padding: 10px; font-size: 16px; margin-left: 40px;"><a  href="voCarmech.php">Cancel</a></button>
            </div>
            </div>
            <?php }}?>
        </form>
        </section> -->

        
      
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>