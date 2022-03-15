CarUser.php
<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
$custAddress1=$_SESSION['custAddress'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
<?php
    include('Uheader.php');
    ?>
    
    <div class="master-container">
        <section>
            <div class="container">
                <center><h1>Available Car Mechanics</h1></center>
                <div class="searchbar">
                    <input type="text" class="search-bar" placeholder="Search here...">
                    <div class="filter">
                        <img src="img/filter.png" alt="">
                    </div>
                </div>
                <div class="mechanic-table" style="overflow-y:auto;">
                    <table class="mechanic-all">
                        <thead>
                            <tr>
                            <th style="font-size: 15px">Profile</th>
                            <th style="font-size: 15px">Name</th>
                            <th style="font-size: 15px">Specialization</th>
                            <th style="font-size: 15px">Address</th>
                            <th style="font-size: 15px">Rating</th>
                            <th style="font-size: 15px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                            $sql="SELECT * from mechanic WHERE mechAddress='$custAddress1' and Specialization='Car Mechanic'";
							$query=$dbh->prepare($sql);

							$query->execute();
							$results=$query->fetchALL(PDO::FETCH_OBJ);

							if($query->rowCount()>0)
                            {
 							foreach($results as $result)   
                            {   
                                if($custAddress1==$custAddress1)
                                {
						    ?>
                            <tr>
                                <td>
                                <img src="img/avatar.png" alt="avatar" width="35"class="img-thumbnail">
                                </td>
                                <td>
                                <?php echo htmlentities($result->mechFirstname);?> <?php echo htmlentities($result->mechLastname);?>
                                </td>
                                <td>
                                <?php echo htmlentities($result->Specialization);?>
                                </td>
                                <td>
                                <?php echo htmlentities($result->mechAddress);?>
                                </td>
                                <td>
                                5
                                </td>
                                <td>
                                <button style="color: rgb(156, 28, 150); border-radius: 8%; padding: 10px; font-size: 16px"><a  href="CarRequestPage.php?regeditid=<?php echo htmlentities($result->mechID)?>">Request</a></button>
                                </td>
                            </tr>
                        </tbody>
                        <?php }}}?>
                    </table>
                </div>
            </div>
        </section>
        
        <!-- <div class="bottom-nav">
            <div class="vehicle-logo">
                <a href="userDashboard.html"><img src="img/steering-wheel2.png" alt=""></a>
            </div>
            <div class="home-logo">
                <a href="userDashboard.html"><img src="img/house-black-silhouette-without-door.png" alt=""></a>
            </div>
            <div class="mech-logo">
                <a href="mechanicPage.html"><img src="img/mechtool.png" alt=""></a>
            </div>
        </div> -->
        <?php
        include('bottom-nav.php');
        ?>
    </div>

    <script src="js/main.js"></script>
</body>
</html>


=====================================================================================================================================================
 CarRequestPage.php


<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
if(isset($_POST['send']))  
{  
$host="localhost";
$username="root"; 
$word="";
$db_name="mechanicnow"; 
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
foreach($checkbox1 as $chk1)  
   {  
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
$in_ch=mysqli_query($con,"INSERT INTO request(mechName, vOwnerName, specMessage, mechRepair, serviceType, ServiceN, mechID, custID, mechAddress, custAddress) values ('$mechN', '$vON' , '$spec', '$chk', '$Specl', '$serv', '$mID', '$custID1', '$mechAdd', '$custAdd')");  
if($in_ch==1)  
   {  
    echo'<script>alert("Request Sent Successfully, Wait for Mechanic to Confirm!")</script>';  
    echo"<script>location.replace('RequestHistoryPage.php');</script>";  
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
<?php
    include('Uheader.php');
    ?>
    
    <div class="master-container">
        
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
                <button style="color: rgb(156, 28, 150); border-radius: 8%; padding: 10px; font-size: 16px; margin-left: 40px;"><a  href="carUSer.php">Cancel</a></button>
            </div>
            </div>
            <?php }}?>
        </form>
        </section>

        <!-- <div class="bottom-nav">
            <div class="vehicle-logo">
                <a href="userDashboard.html"><img src="img/steering-wheel2.png" alt=""></a>
            </div>
            <div class="home-logo">
                <a href="userDashboard.html"><img src="img/house-black-silhouette-without-door.png" alt=""></a>
            </div>
            <div class="mech-logo">
                <a href="mechanicPage.html"><img src="img/mechtool.png" alt=""></a>
            </div>
        </div> -->
        <?php
        include('bottom-nav.php');
        ?>
    </div>

    <script src="js/main.js">
         
    </script>

    
</body>
</html>
=============================================================
requestHistoryPage.php


<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
    <?php include('Uheader.php');?>
    
    <div class="master-container">
        <section>
        <form method= "POST">
        <div class="container">
                <h1 class="mdb">Ongoing Request</h1>
        <?php
              $sql="SELECT * from request WHERE custID=$custID1 and Status='Unaccepted' order by resID DESC";
              $query=$dbh->prepare($sql);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result)
              {
                  if($custID1==$custID1)
                  {

        ?>
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->mechName);?></h3>
                                    <p><strong>Description : </strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p id="status" ><strong>Status: </strong> <?php echo htmlentities($result->Status);?></p>
                                    <p><strong>Specific Message:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php }}}?>
            </div>
            </form>
        </section>
        <?php include('Mbootom-nav.php');?>
    </div>

    <script src="js/main.js">
        var status = document.getElementById('status');
        if(status == 'Unaccepted')
        {
            document.getElementById("message").disable;      
        }
    </script>
</body>
</html>
================================================================
monitorMechanicservices.php


<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
$custID1=$_SESSION['custID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
    <?php include('Uheader.php');?>
    
    <div class="master-container">
        <section>
        <form method= "POST">
        <div class="container">
                <h1 class="mdb">Monitor Mechanic Services</h1>
        <?php
              $sql="SELECT * from request WHERE custID=$custID1 and Status='Accepted' order by resID DESC";
              $query=$dbh->prepare($sql);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result)
              {
                  if($custID1==$custID1)
                  {

        ?>
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->mechName);?></h3>
                                    <p><strong>Description : </strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p id="status" ><strong>Status: </strong> <?php echo htmlentities($result->Status);?></p>
                                    <p><strong>Specific Message:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                    <div class="card-btn">
                                        <button type="submit" name="submit" id="message" class="accept">Message</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php }}}?>
            </div>
            </form>
        </section>
        <?php include('Mbootom-nav.php');?>
    </div>

    <script src="js/main.js">
        var status = document.getElementById('status');
        if(status == 'Unaccepted')
        {
            document.getElementById("message").disable;      
        }
    </script>
</body>
</html>
======================================================================
mechanicDashboard.php

<?php
session_start();
include('config.php');
$mechID1=$_SESSION['mechID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
    <?php include('Mheader.php');?>
    
    <div class="master-container">
        <section>
        <form method= "POST">
        <div class="container">
                <h1 class="mdb">Customers Request</h1>
        <?php
              $sql="SELECT * from request WHERE mechID=$mechID1 and Status='Unaccepted'";
              $query=$dbh->prepare($sql);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result)
              {
                  if($mechID1==$mechID1)
                  {

        ?>
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                                    <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>
                                    <p><strong>Service Needed: </strong> <?php echo htmlentities($result->ServiceN);?></p>
                                    <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                    <div class="card-btn">
                                        <button type="submit" name="submit" class="accept"><a href="mechanicRequestLog.php?regeditid=<?php echo htmlentities($result->resID)?>">Accept</a></button>
                                        <button class="decline">Decline</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php }}}?>
            </div>
            </form>
        </section>
        <?php include('Mbootom-nav.php');?>
    </div>

    <script src="js/main.js"></script>
</body>
</html>
====================================================================
mechanicRequestLog.php

<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
if(isset($_POST['sendMessage']))
{
    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set Status='Accepted' where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();
    echo"<script>location.replace('mechanicActivityLog.php');</script>";
}
$mechID1=$_SESSION['mechID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
    <?php include('Mheader.php');?>
    
    <div class="master-container">
        <section>
        <form method= "POST">
        <?php
              $regeditid=intval($_GET['regeditid']);
              $sql="SELECT * from request WHERE resID=:regeditid and Status='Unaccepted'";
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
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                                    <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>
                                    <p><strong>Service Needed: </strong> <?php echo htmlentities($result->ServiceN);?></p>
                                    <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                    <textarea placeholder="Specify here..." name="specMessage" value="specMessage" style="padding: 30px; font-size: 12px; font-family: var(--ff-primary);"></textarea>
                                    <div class="card-btn">
                                        <button type="submit" class="accept" name="sendMessage">Send Message</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php }}?>
            </form>
        </section>
        <?php include('Mbootom-nav.php');?>
    </div>

    <script src="js/main.js"></script>
</body>
</html>
========================================================
mechanicActivityLog.php

<?php
session_start();
include('C:\xampp\htdocs\Mechanicnow\config.php');
$mechID1=$_SESSION['mechID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Stick+No+Bills:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Mechanic Now</title>
</head>
<body>
    <?php include('Mheader.php');?>
    
    <div class="master-container">
        <section>
        <form method= "POST">
        <div class="container">
                <h1 class="mdb">Activity log </h1>
        <?php
              $sql="SELECT * from request WHERE mechID=$mechID1 and Status='Accepted'";
              $query=$dbh->prepare($sql);
              $query->execute();
              $results=$query->fetchALL(PDO::FETCH_OBJ);

              if($query->rowCount()>0)
              {
              foreach ($results as $result) 
              {
                if($mechID1==$mechID1)
                {
        ?>       
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                                    <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>
                                    <p><strong>Service Needed: </strong> <?php echo htmlentities($result->ServiceN);?></p>
                                    <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                    <textarea placeholder="Specify here..." name="specMessage" value="specMessage" style="padding: 30px; font-size: 12px; font-family: var(--ff-primary);"></textarea>
                                    <div class="card-btn">
                                        <button class="accept">Send Message</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
            <?php }}}?>
            </div>
            </div>
            </form>
        </section>
        <?php include('Mbootom-nav.php');?>
    </div>

    <script src="js/main.js"></script>
</body>
</html>

