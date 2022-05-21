<?php
session_start();
include('C:\xampp\htdocs\Devgru_Mechanicnow\config.php');
if(empty($_SESSION['mechID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['mechID']);
      }
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
$mechID1=$_SESSION['mechID']; 
if(empty($_SESSION['mechID'])){
    header("Location:http://localhost/Devgru_Mechanicnow/login.php");
    session_destroy(); 
    unset($_SESSION['mechID']);
      }
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
    <?php include('mechHeader.php');?>
    <?php include('./mechTopnav.php');?>
    
    <section id="activityLog">
        <div class="row py-0 px-sm-0 px-md-3 table-responsive justify-content-center pb-5">
            <div class="col-lg-8  py-4  ">
                <?php
                    $sql="SELECT * from request WHERE mechID and status='complete' order by resID DESC";
                    $query=$dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach ($results as $result){
                            if($result->mechID == $mechID1){
                ?>
                <div class="card text-dark mb-2">
                    <!-- <div class="card-header">
                        
                    </div> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlentities($result->vOwnerName);?></h5>
                        <p class="card-text"><?php echo htmlentities($result->mechRepair);?></p>
                        <h6 class="pt-2">Note:</h6>
                        <p class="card-text"><?php echo htmlentities($result->specMessage);?></p>
                        <p class="card-text float-end"><?php echo htmlentities($result->status);?></p>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
                <?php }}} 
                    
                    else {
                    ?>
                    <div class="emptyrequest mt-5 pt-5" >
                            <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                            <h6>No transaction history at the moment. . .</h6>
                   </div>
                   <?php
                    }
                    ?> 
            </div>
        </div>

    </section>
</body>
</html>
