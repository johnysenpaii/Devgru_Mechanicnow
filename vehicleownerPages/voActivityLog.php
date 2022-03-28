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
    <?php include('./voTopnav.php');?>

    <section id="activityLog">
        <form action="" method="POST">
            <div class="row py-3 px-sm-0 px-md-3 table-responsive justify-content-center pb-5">
                <div class="col-lg-8  py-4  ">
                    <?php
                    $sql="SELECT * from request WHERE custID=$custID1 and status='Accepted' || status='verify' order by resID DESC";
                    $query=$dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                    if($query->rowCount()>0){
                        foreach ($results as $result){
                            if($custID1==$custID1){
                ?>
                    <div class="card text-dark mb-2">
                        <!-- <div class="card-header">
                        
                    </div> -->
                        <div class="card-body">
                            <input type="text" hidden name="resID" value="<?php echo htmlentities($result->resID);?>">
                            <h5 class="card-title"><?php echo htmlentities($result->mechName);?></h5>
                            <p><?php echo htmlentities($result->custAddress);?></p>
                            <p class="card-text"><?php echo htmlentities($result->mechRepair);?></p>
                            <h6 class="pt-2">Note:</h6>
                            <p class="card-text"><?php echo htmlentities($result->specMessage);?></p>
                            <p class="card-text float-end"><?php echo htmlentities($result->status);?></p>
                            <button class="btn btn-outline-primary" type="submit" value="confirm" name="confirm">Confirm</button>
                            <!-- Button trigger modal -->

                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                    <?php }}} 
                    
                    else {
                    ?>
                    <div class="emptyrequest mt-5 pt-5">
                        <div class="emptydiv"><img src="../img/empty.png" alt=""></div>
                        <h6>No available activities. . .</h6>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </section>
    
    <script>
    </script>

</body>

</html>