<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
$mechID1=$_SESSION['mechID'];




if(isset($_POST['logout'])) {
    $regeditid = $_SESSION['mechID'];
    $sql="UPDATE mechanic set stats='Not active' WHERE mechID=:regeditid"; //,Password=:Password ,Specialization=:Specialization,mechValidID=:mechValidID
    $query=$dbh->prepare($sql);
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR);
    $query->execute(); 
    session_destroy();
    unset($_SESSION['mechID']);
    header('location:http://localhost/Devgru_Mechanicnow/login.php');
} 

if(isset($_POST['Accept']))
{
    $regeditid12 = $_SESSION['mechID'];
    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set status='Accepted' where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();
// <<<<<<< Updated upstream
//     echo"<script>location.replace('mechActivityLog.php');</script>";
// ======= 

    $custID = $_POST['custID'];
    $mechID = $_POST['mechID'];
    $custName = $_POST['custName'];
    $mechName = $_POST['mechName'];
    $specMessage = $_POST['specMessage'];
    $role = $_POST['role'];

    $sql4 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID, :mechID, 'Accepted')";
    $query4 = $dbh->prepare($sql4);
    $query4->bindParam(':custID',$custID,PDO::PARAM_STR);
    $query4->bindParam(':mechID',$mechID,PDO::PARAM_STR);
    $query4->execute();

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

    $sql13="UPDATE mechanic set status='busy' where mechID=:regeditid12";
    $query13=$dbh->prepare($sql13); 
    $query13->bindParam(':regeditid12',$regeditid12,PDO::PARAM_STR); 
    $query13->execute();

}
if(isset($_POST['Decline']))
{   
    $custID12= $_POST['custID'];
    $mechID12 = $_POST['mechID'];
    $sql0 = "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID12, :mechID12,'Decline')";
    $query0 = $dbh->prepare($sql0);
    $query0->bindParam(':custID12',$custID12,PDO::PARAM_STR);
    $query0->bindParam(':mechID12',$mechID12,PDO::PARAM_STR);
    $query0->execute();

    $regeditid=intval($_GET['regeditid']);
    $sql="UPDATE request set status='Decline' where resID=:regeditid";
    $query=$dbh->prepare($sql); 
    $query->bindParam(':regeditid',$regeditid,PDO::PARAM_STR); 
    $query->execute();
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

    
    <div class="master-container">
        <section>
        <form method= "POST">
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
                $date = date("Y-m-d");
                echo $date;
                if($result->date == $date ){
                
                    $custID12= $_POST['custID'];
                    $mechID12 = $_POST['mechID'];
                    $sql41= "INSERT INTO vonotification(custID, mechID, status) VALUES(:custID12, :mechID12, 'Home service')";
                    $query41= $dbh->prepare($sql41);
                    $query41->bindParam(':custID12',$custID12,PDO::PARAM_STR);
                    $query41->bindParam(':mechID12',$mechID12,PDO::PARAM_STR);
                    $query41->execute();
                
                    $sql41= "INSERT INTO notification(custID, mechID, status) VALUES(:custID12, :mechID12, 'Home service')";
                    $query41= $dbh->prepare($sql41);
                    $query41->bindParam(':custID12',$custID12,PDO::PARAM_STR);
                    $query41->bindParam(':mechID12',$mechID12,PDO::PARAM_STR);
                    $query41->execute();
                
                
                }
        ?>
        <div class="container">
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                                    <input type="text" name="custID" value="<?php echo htmlentities($result->custID);?>">
                                    <input type="text" name="mechID" value="<?php echo htmlentities($result->mechID);?>">
                                    <input type="text" name="date1" value="<?php echo htmlentities($result->date);?>">
                                    <input type="text" name="timess" value="<?php echo htmlentities($result->timess);?>">
                                    <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>

                                    <!-- <p id="service"><strong>Service Needed: </strong><?php echo htmlentities($result->serviceNeeded);?></p> -->
                                    <input id="service" type="text" value="<?php echo htmlentities($result->serviceNeeded);?>">
                                    <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <!-- <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p> -->
                                    <textarea placeholder="Specify here..." name="specMessage" value="specMessage" style="padding: 30px; font-size: 12px; font-family: var(--ff-primary);"></textarea>
                                    <div class="card-btn">
                                        <button type="submit" id="emer" class="accept" name="Accept">Accept</button>
                                        <button type="submit" id="home"  class="accept" name="AcceptHomeservice">Accept121</button>

                                        <button  type="submit" class="decline" name="Decline">Decline</button>
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
       
    </div>

    <script src="js/main.js">
        var service = document.getElementById('service').value;
        if(service == "Home Service"){
             document.getElementById('emer').style.display="none";
            document.getElementById('home').style.display="block";
        }

    </script>
</body>
</html>
