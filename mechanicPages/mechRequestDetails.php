<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
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
<<<<<<< Updated upstream
    echo"<script>location.replace('mechActivityLog.php');</script>";
=======

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
>>>>>>> Stashed changes
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
        ?>
        <div class="container">
                <div class="request-table">
                    <table class = "table-card">
                        <tr class = "row-card">
                            <td class= "data-card">
                                <div class="td-card">
                                    <h3><?php echo htmlentities($result->vOwnerName);?></h3>
                                    <p><strong>Service Type: </strong> <?php echo htmlentities($result->serviceType);?></p>
                                    <p><strong>Service Needed: </strong> <?php echo htmlentities($result->serviceNeeded);?></p>
                                    <p><strong>Vehicle Problem:</strong> <?php echo htmlentities($result->mechRepair);?></p>
                                    <p><strong>Note:</strong> <?php echo htmlentities($result->specMessage);?></p>
                                    <p><strong>Address:</strong> <?php echo htmlentities($result->custAddress);?></p>
                                    <textarea placeholder="Specify here..." name="specMessage" value="specMessage" style="padding: 30px; font-size: 12px; font-family: var(--ff-primary);"></textarea>
                                    <div class="card-btn">
                                        <button type="submit" class="accept" name="Accept">Accept</button>
                                        <button class="decline">Decline</button>
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

    <script src="js/main.js"></script>
</body>
</html>
