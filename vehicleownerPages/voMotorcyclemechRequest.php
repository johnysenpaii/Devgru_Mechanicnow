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

    <section id="mechContent" class="mech-content container-fluid">
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
                <input type="checkbox" name="mechRepair[]" value="Chain Loosening Repair">
                <label>Chain Loosening Repair</label>
                <p></p>
                <br>
                <input type="checkbox" name="mechRepair[]" value="Break Repair">
                <label>Break Repair</label>
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
        </section>

        
      
    </section>
    <div class="row d-block d-lg-none"><?php include('voBottom-nav.php');?></div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>